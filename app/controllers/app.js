
// sempre que a pag for recarregada o localStorage é limpo
localStorage.clear()


class Convidado{ 
    constructor(convidado ){
        this.nome = convidado
        
    }

    validarDados(){
        //this faz referencia a classe, usando this[] acessamos os atributos (this[0] se refere a "nome")
        
        if (this.nome === null || this.nome === undefined || this.nome === ""){ 
            return false
        }        
    }
}


class Bd { //acoes envolvendo manipulacao de dados do BD

    constructor(){

        let idLocalStorage = localStorage.getItem("id") // null porque a chave id nao existe

        if(idLocalStorage === null){ //caso nao exista uma key(id) é criado uma com valor 0
            localStorage.setItem("id", 0) 
        }
    }

    getProximoId(){
        let idLocalStorage = localStorage.getItem("id") 
        let ProximoId = parseInt(idLocalStorage) + 1 ;

        return ProximoId
    }

    gravar( convidado ){

        convidado.validarDados();

        let id = this.getProximoId()
        localStorage.setItem("id", id) //setando o valor da key(id) com valor atualizado pela funcao getProximoId

        localStorage.setItem( id, JSON.stringify( convidado )) // atribuindo um json com {nome : "nome_exemplo"}
    }

    recuperarRegistros(){

        let id = localStorage.getItem("id") //recupera a key id 
        let array_convidados_bd = [] ; 
        
        for(let i = 1; i <=id; i++ ){

            let convidado_bd = JSON.parse( localStorage.getItem(i) ) 

            if( convidado_bd === null ){
                continue // pula para a proxima iteracao caso convidado seja null
            }

            convidado_bd.id = i // atribuindo id 
            array_convidados_bd.push( convidado_bd ) // atribuindo convidado
        }
        return array_convidados_bd
    }

    removerConvidado(id){
        
        localStorage.removeItem(id)
        carregaTabelaConvidados()
    }

}
let bd = new Bd() ; //instanciando



//pagina de consulta

function carregaTabelaConvidados( arrayConvidados = Array() ){ //carregar dados na Tabela de consulta

    if(arrayConvidados.length == 0 ){
        arrayConvidados = bd.recuperarRegistros() //recebendo array do BD 
    }

    //selecionando o elemento Tbody da tabela
    let Tbody_convidados = document.querySelector("#Tbody_convidados")
    Tbody_convidados.innerHTML = ""


    arrayConvidados.forEach( (convidado) => { //recuperando os valores do array

        
        //criando linha da tabela 
        let linha = Tbody_convidados.insertRow()
        
        // criando coluna (td)
        //insetCell busca uma referencia dentro da linha, comecando da esquerda para direita
        //sendo a primeira coluna de indice (0), a segunda com indice (1)

        linha.insertCell(0).innerText = convidado.nome ;
        
        
        let btn = document.createElement("button")
        btn.className = "btn btn-danger"
        btn.innerHTML = "&#10008;"
        // btn.id = convidado.id 

        btn.onclick = function(){ 
            bd.removerConvidado( convidado.id )  
        }

        linha.insertCell(1).append(btn)  //botao de excluir

    });

    
}


function cadastrar_convidado( convidado = document.getElementById("convidado").value){

    let conv = new Convidado(
        //passando os parametros para o construtor da classe
        convidado
    )

    bd.gravar( conv) //gravando
    document.getElementById("convidado").value = ""
    carregaTabelaConvidados()
}


function passaID(id){
    document.querySelector("#id_edit").value = id
}

function passa_convidados(){

    document.querySelector("#lista_convidados").value = ""
    let array_convidados =  bd.recuperarRegistros()      

    array_convidados.forEach(convidados => {
        document.querySelector("#lista_convidados").value += convidados.nome + "/"  
    });
}


btn_submit = document.getElementById("btn_submit")
btn_submit.addEventListener("click" , ()=>{

    passa_convidados()
    document.querySelector("#form").submit()
})
