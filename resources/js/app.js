import "./bootstrap";

import Alpine from "alpinejs";

import mask from "@alpinejs/mask";

import * as utils from "./generic";

import * as Popper from "@popperjs/core";

Alpine.plugin(mask);

window.Alpine = Alpine;


window.Popper = Popper;

Alpine.start();
