let entrada = prompt("Informe o numero de cartas");
let numCarta = parseInt(entrada);
let index = 1;
let p1 = "", p2 = "", p3 = "", p4 = "";

for (let i = 1; i <= numCarta; i++) {
    switch(index){
        case 1:
            p1 += i+", "
            break;
        case 2:
            p2 += i+", "
            break;
        case 3:
            p3 += i+", "
            break;
        case 4:
            p4 += i+", "
            break;
        default:
            console.log("Erro na distribuicao");
            break;
    }
    index++
    if (index > 4) {
        index = 1;
    }
}
    
console.log("Pessoa 1 ficou com as cartas: "+p1)
console.log("Pessoa 2 ficou com as cartas: "+p2)
console.log("Pessoa 3 ficou com as cartas: "+p3)
console.log("Pessoa 4 ficou com as cartas: "+p4)