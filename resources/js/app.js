import "./bootstrap";

import Alpine from "alpinejs";

import mask from "@alpinejs/mask";

import Swal from "sweetalert2";

import jQuery from "jquery";

import "jquery-mask-plugin";

import * as utils from "./generic";

import * as Popper from "@popperjs/core";

Alpine.plugin(mask);

window.Alpine = Alpine;

window.Swal = Swal;

window.$ = jQuery;

window.Popper = Popper;

Alpine.start();
