import "./bootstrap";

import Alpine from "alpinejs";

import mask from "@alpinejs/mask";

import Swal from "sweetalert2";

Alpine.plugin(mask);

window.Alpine = Alpine;

window.Swal = Swal;

Alpine.start();
