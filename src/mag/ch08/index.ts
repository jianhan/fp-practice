import {prop} from "ramda";

const Maybe = require('folktale/maybe');
const compose = require('folktale/core/lambda/compose');
// const map = require('folktale/fantasy-land/map');
import map from "folktale/fantasy-land/map";

const helloWorld = (str: string) => "Hello "  + str + " World";

const sayHello = Maybe.Just({name: "Jim"}).map(prop("name")).map(helloWorld)


const sayHelloCompose = compose();

console.log(sayHello);

// console.log(Maybe.Just("test").map(helloWorld), Maybe.Nothing("test").map(helloWorld));
