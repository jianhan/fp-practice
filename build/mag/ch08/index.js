"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
var ramda_1 = require("ramda");
var Maybe = require('folktale/maybe');
var compose = require('folktale/core/lambda/compose');
var map = require('folktale/fantasy-land/map');
var helloWorld = function (str) { return "Hello " + str + " World"; };
var sayHello = Maybe.Just({ name: "Jim" }).map(ramda_1.prop("name")).map(helloWorld);
console.log(sayHello);
// console.log(Maybe.Just("test").map(helloWorld), Maybe.Nothing("test").map(helloWorld));