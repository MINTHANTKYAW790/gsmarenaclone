import "./bootstrap";
import "admin-lte/plugins/jquery/jquery.min.js";
import "admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js";
import "admin-lte/dist/js/adminlte.min.js";
import "datatables.net-fixedcolumns";
import DataTable from "datatables.net";
import "datatables.net-bs4";
import toastr from "toastr";
window.toastr = toastr;
import Swal from "sweetalert2/dist/sweetalert2";
window.Swal = Swal;
import 'virtual-select-plugin/dist/virtual-select.min.js';
$('[data-toggle="popover"]').popover();
import './app/datatables';
import './app/common';
import './sweetalert2.min';
import '../css/app.scss';

