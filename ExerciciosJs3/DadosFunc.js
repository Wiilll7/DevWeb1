let dados = []
let iNome = 0
let iIdade = 0

for (let i = 0; i < 5; i++) {
    dados.push(
        {
            "id": prompt("Insira o ID: "),
            "nome": prompt("Insira o Nome: "),
            "salario": prompt("Insira o salario: "),
            "idade": prompt("Insira a idade: ")
        }
    )

    if (dados[i].idade < dados[iNome].idade) {
        iNome = i;
    }

    if (dados[i].salario > dados[iIdade].salario) {
        iIdade = i;
    }
}

document.write("<table>"+
    "<thead>"+
        "<tr>"+
            "<td>ID</td>"+
            "<td>Nome</td>"+
            "<td>Salario</td>"+
            "<td>Idade</td>"+
        "</tr>"+
    "</thead>"+
    "<body>"+
        "<tr>"+
            "<td>"+dados[0].id+"</td>"+
            "<td>"+dados[0].nome+"</td>"+
            "<td>"+dados[0].salario+"</td>"+
            "<td>"+dados[0].idade+"</td>"+
        "</tr>"+
        "<tr>"+
            "<td>"+dados[1].id+"</td>"+
            "<td>"+dados[1].nome+"</td>"+
            "<td>"+dados[1].salario+"</td>"+
            "<td>"+dados[1].idade+"</td>"+        
        "</tr>"+
        "<tr>"+
            "<td>"+dados[2].id+"</td>"+
            "<td>"+dados[2].nome+"</td>"+
            "<td>"+dados[2].salario+"</td>"+
            "<td>"+dados[2].idade+"</td>"+
        "</tr>"+
        "<tr>"+
            "<td>"+dados[3].id+"</td>"+
            "<td>"+dados[3].nome+"</td>"+
            "<td>"+dados[3].salario+"</td>"+
            "<td>"+dados[3].idade+"</td>"+
        "</tr>"+
        "<tr>"+
            "<td>"+dados[4].id+"</td>"+
            "<td>"+dados[4].nome+"</td>"+
            "<td>"+dados[4].salario+"</td>"+
            "<td>"+dados[4].idade+"</td>"+
        "</tr>"+
        "<tr>"+
            "<td>Nome Novo</td>"+
            "<td>"+dados[iNome].nome+"</td>"+
            "<td></td>"+
            "<td></td>"+
        "</tr>"+
        "<tr>"+
            "<td>Idade Salario</td>"+
            "<td>"+dados[iIdade].idade+"</td>"+
            "<td></td>"+
            "<td></td>"+
        "</tr>"+
    "</body>"+
"</table>")