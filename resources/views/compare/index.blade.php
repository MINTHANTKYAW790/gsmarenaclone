@extends('layouts.application')

@section('content')
<div class="mainContainer">
    <div class="row mb-2">
        {{-- LEFT device --}}
        <div id="device-selector-left" class="col-md-6 mb-3">
            <div class="row">
                <!-- Brand Dropdown -->
                <div class="col-sm-4">
                    <label>Brand</label>
                    <select id="brand-select-left" class="form-control form-control-sm" onchange="loadDevicesLeft()">
                        <option value="">-- Choose Brand --</option>
                        @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Device Dropdown -->
                <div class="col-sm-4">
                    <label>Device</label>
                    <select class="form-control form-control-sm" id="device-select-left"></select>
                </div>

                <!-- Load Button -->
                <div class="col-sm-4 d-flex align-items-end">
                    <button onclick="loadDeviceDetailLeft()" class="btn btn-primary w-100" style="background-color: #003684; color:white">Compare</button>
                </div>
            </div>
        </div>

        {{-- RIGHT device --}}
        <div id="device-selector-right" class="col-md-6 mb-3">
            <div class="row">
                <!-- Brand Dropdown -->
                <div class="col-sm-4">
                    <label>Brand</label>
                    <select id="brand-select-right" class="form-control form-control-sm" onchange="loadDevicesRight()">
                        <option value="">-- Choose Brand --</option>
                        @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Device Dropdown -->
                <div class="col-sm-4">
                    <label>Device</label>
                    <select class="form-control form-control-sm" id="device-select-right"></select>
                </div>

                <!-- Load Button -->
                <div class="col-sm-4 d-flex align-items-end">
                    <button onclick="loadDeviceDetailRight()" class="btn w-100" style="background-color: #003684; color:white">Compare</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Comparison Table Placeholder -->
</div>
<div id="comparison-table" class="comparisonTable"></div>

<script>
    let currentSide = null;

    const selectedDevices = {
        left: null,
        right: null
    };

    // function selectDevice(side) {
    //     currentSide = side;
    //     document.getElementById('device-selector').style.display = 'block';
    // }

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
                // document.getElementById('device-selector-left').style.display = 'block';
                renderComparisonTable();
            });
    }

    function loadDeviceDetailRight() {
        const deviceId = document.getElementById('device-select-right').value;
        fetch(`/compare/load-device/${deviceId}`)
            .then(res => res.json())
            .then(device => {
                selectedDevices['right'] = device;
                // document.getElementById('device-selector-right').style.display = 'block';
                renderComparisonTable();
            });
    }

    function renderComparisonTable() {
        const {
            left,
            right
        } = selectedDevices;

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
            <div class="tableContainer">
            <h4 class="pl-2">Device Comparison</h4>
            <table class="comparison-table" cellpadding="8" style=" width:100%;">
                <thead>
                    <tr>
                        <th style="color:#003684">Spec Category</th>
                        <th></th>
                        <th>
                            ${left?.name || 'N/A'}<br>
                            ${left?.image_url ? `<img src="/images/${left.image_url.split('/').pop()}" style="max-height: 200px; margin: 6px 0;" alt="${left.name}">` : ''}
                            ${left?.price ? `<div style="color:green;">$${left.price}</div>` : ''}
                        </th>
                        <th>
                            ${right?.name || 'N/A'}<br>
                            ${right?.image_url ? `<img src="/images/${right.image_url.split('/').pop()}" style="max-height: 200px; margin: 6px 0;" alt="${right.name}">` : ''}
                            ${right?.price ? `<div style="color:green;">$${right.price}</div>` : ''}
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

                html += `
                <tr class="category-separator">
                    <td colspan="4"></td>
                </tr>`;
            }
        }
        html += `</tbody></table></div>`;
        document.getElementById('comparison-table').innerHTML = html;
    }
</script>
@endsection