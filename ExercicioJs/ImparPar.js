let num = prompt("Informe um numero")
let v;

if (num % 2 == 0) {
    v = true;
} else {
    v = false;
}

switch(v) {
    case true:
        console.log("E par")
        break;
    case false:
        console.log("E impar")
        break;
}