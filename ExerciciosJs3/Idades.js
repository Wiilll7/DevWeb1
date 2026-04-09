let idades = []

for (let i = 0; i < 10; i++) {
    idades[i] = prompt("Insira a idade da pessoa "+(i+1)+": \n")
}

for (let i = 0; i < 10; i++) {
    console.log("Idade "+(i+1)+": "+idades[i])
}

console.log("----------------------------------")
// Ordenada crescente
idades.sort()

for (let i = 0; i < 10; i++) {
    console.log("Idade "+(i+1)+": "+idades[i])
}

console.log("----------------------------------")
// Ordenada decrescente
for (let i = 9; i >= 0; i--) {
    console.log("Idade "+(i+1)+": "+idades[i])
}