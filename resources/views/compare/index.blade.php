@extends('layouts.application')

@section('content')
<style>
    body {
        background: #f7f9fb;
    }
    .device-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        padding: 24px 18px 18px 18px;
        margin-bottom: 20px;
    }
    .device-card label {
        font-weight: 500;
        color: black;
    }
    .comparison-table {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        margin-top: 30px;
        overflow-x: auto;
    }
    .comparison-table th, .comparison-table td {
        text-align: center;
        vertical-align: middle;
        color: black; /* <-- Added to set text color as before */
    }
    .comparison-table th {
        background: #fff3ec;
        color: black;
        font-size: 1.1rem;
        border-top: none;
    }
    .comparison-table tr:nth-child(even) td {
        background: #f7f9fb;
    }
    .specCategory {
        min-width: 120px;
        font-weight: 600;
        color: black;
    }
    .category-separator td {
        border-bottom: 2px solid #fff3ec;
        height: 8px;
        background: #fff !important;
    }
    .btn-compare {
        background: linear-gradient(90deg, #F26522 60%, #ff8c4a 100%);
        color: #fff;
        font-weight: 600;
        border: none;
        border-radius: 6px;
        transition: background 0.2s;
    }
    .btn-compare:hover {
        background: linear-gradient(90deg, #ff8c4a 60%, #F26522 100%);
    }
    .device-img {
        max-height: 120px;
        margin: 8px 0;
        border-radius: 8px;
        box-shadow: 0 1px 6px rgba(0,0,0,0.08);
    }
    h5, h4, label, .specCategory {
        color: black !important;
    }
    @media (max-width: 767px) {
        .device-card {
            padding: 12px 6px;
        }
        .comparison-table th, .comparison-table td {
            font-size: 0.95rem;
        }
    }
</style>
<div class="mainContainer container">
    <div class="row mb-3">
        <!-- LEFT device -->
        <div class="col-md-6">
            <div class="device-card">
                <div class="row g-2">
                    <div class="col-12 mb-2 text-center">
                        <h5 style="font-weight:700;">Device 1</h5>
                    </div>
                    <div class="col-sm-4 mb-2">
                        <label>Brand</label>
                        <select id="brand-select-left" class="form-control form-control-sm" onchange="loadDevicesLeft()">
                            <option value="">-- Choose Brand --</option>
                            @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4 mb-2">
                        <label>Device</label>
                        <select class="form-control form-control-sm" id="device-select-left"></select>
                    </div>
                    <div class="col-sm-4 mb-2 d-flex align-items-end">
                        <button onclick="loadDeviceDetailLeft()" class="btn btn-compare w-100">Compare</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- RIGHT device -->
        <div class="col-md-6">
            <div class="device-card">
                <div class="row g-2">
                    <div class="col-12 mb-2 text-center">
                        <h5 style="font-weight:700;">Device 2</h5>
                    </div>
                    <div class="col-sm-4 mb-2">
                        <label>Brand</label>
                        <select id="brand-select-right" class="form-control form-control-sm" onchange="loadDevicesRight()">
                            <option value="">-- Choose Brand --</option>
                            @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4 mb-2">
                        <label>Device</label>
                        <select class="form-control form-control-sm" id="device-select-right"></select>
                    </div>
                    <div class="col-sm-4 mb-2 d-flex align-items-end">
                        <button onclick="loadDeviceDetailRight()" class="btn btn-compare w-100">Compare</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Comparison Table Placeholder -->
    <div id="comparison-table" class="comparisonTable"></div>
</div>

<script>
    let currentSide = null;

    const selectedDevices = {
        left: null,
        right: null
    };

    function loadDevicesLeft() {
        const brandId = document.getElementById('brand-select-left').value;
        fetch(`/api/brand/${brandId}/devices`)
            .then(res => res.json())
            .then(devices => {
                const select = document.getElementById('device-select-left');
                select.innerHTML = '';
                devices.forEach(device => {
                    let option = document.createElement('option');
                    option.value = device.id;
                    option.text = device.name;
                    select.appendChild(option);
                });
            });
    }

    function loadDevicesRight() {
        const brandId = document.getElementById('brand-select-right').value;
        fetch(`/api/brand/${brandId}/devices`)
            .then(res => res.json())
            .then(devices => {
                const select = document.getElementById('device-select-right');
                select.innerHTML = '';
                devices.forEach(device => {
                    let option = document.createElement('option');
                    option.value = device.id;
                    option.text = device.name;
                    select.appendChild(option);
                });
            });
    }

    function loadDeviceDetailLeft() {
        const deviceId = document.getElementById('device-select-left').value;
        fetch(`/compare/load-device/${deviceId}`)
            .then(res => res.json())
            .then(device => {
                selectedDevices['left'] = device;
                renderComparisonTable();
            });
    }

    function loadDeviceDetailRight() {
        const deviceId = document.getElementById('device-select-right').value;
        fetch(`/compare/load-device/${deviceId}`)
            .then(res => res.json())
            .then(device => {
                selectedDevices['right'] = device;
                renderComparisonTable();
            });
    }

    function renderComparisonTable() {
        const { left, right } = selectedDevices;

        let specMap = {};

        [left, right].forEach((device, idx) => {
            if (!device) return;
            device.specs.forEach(spec => {
                if (!spec.category?.name) return;
                const cat = spec.category.name;
                const key = spec.key;
                if (!specMap[cat]) specMap[cat] = {};
                if (!specMap[cat][key]) specMap[cat][key] = [null, null]; // [left, right]
                specMap[cat][key][idx] = spec.value;
            });
        });

        let html = `
            <div class="tableContainer p-3">
            <h4 class="pl-2 mb-3" style="font-weight:700;">Device Comparison</h4>
            <table class="comparison-table table table-bordered" cellpadding="8" style="width:100%;">
                <thead>
                    <tr>
                        <th style="width:18%;">Spec Category</th>
                        <th style="width:22%;">Spec</th>
                        <th style="width:30%;">
                            ${left?.name || 'N/A'}<br>
                            ${left?.image_url ? `<img src="/images/${left.image_url.split('/').pop()}" class="device-img" alt="${left.name}">` : ''}
                            ${left?.price ? `<div style="color:green;font-weight:600;">$${left.price}</div>` : ''}
                        </th>
                        <th style="width:30%;">
                            ${right?.name || 'N/A'}<br>
                            ${right?.image_url ? `<img src="/images/${right.image_url.split('/').pop()}" class="device-img" alt="${right.name}">` : ''}
                            ${right?.price ? `<div style="color:green;font-weight:600;">$${right.price}</div>` : ''}
                        </th>
                    </tr>
                </thead>
                <tbody>
        `;

        for (const [cat, specs] of Object.entries(specMap)) {
            let firstRow = true;
            for (const [key, [leftVal, rightVal]] of Object.entries(specs)) {
                html += `
                <tr>
                    <td class="specCategory">${firstRow ? `<strong>${cat}</strong>` : ''}</td>
                    <td>${key}</td>
                    <td>${leftVal || '-'}</td>
                    <td>${rightVal || '-'}</td>
                </tr>`;
                firstRow = false;
            }
            html += `
                <tr class="category-separator">
                    <td colspan="4"></td>
                </tr>`;
        }
        html += `</tbody></table></div>`;
        document.getElementById('comparison-table').innerHTML = html;
    }
</script>
@endsection