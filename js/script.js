(function () {
  'use strict'

  var forms = document.querySelectorAll('.needs-validation')

  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()

//SCRIPT PARA FAZER A CONSULTA POR MES
var searchAtiva = document.getElementById('mes');
function searchDataAtivas() {window.location = 'solicitacoes_ativas.php?search='+searchAtiva.value;}

var searchConcluida = document.getElementById('mes');
function searchDataConcluidas() {window.location = 'solicitacoes_concluidas.php?search='+searchConcluida.value;}

var searchContador = document.getElementById('mes');
function searchDataContador() {window.location = 'sistema_contadores.php?search='+searchContador.value;}

//SCRIPT PARA PREENCHER ENDERECO
function limpa_formulário_cep() { //Limpa valores do formulário de cep.           
        document.getElementById('rua').value=("");
        document.getElementById('bairro').value=("");
}
function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {//Atualiza os campos com os valores.
        document.getElementById('rua').value=(conteudo.logradouro);
        document.getElementById('bairro').value=(conteudo.bairro);
    }
    else {//CEP não Encontrado.            
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}        
function pesquisacep(valor) {
    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');
    //Verifica se campo cep possui valor informado.
    if (cep != "") {
        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;
        //Valida o formato do CEP.
        if(validacep.test(cep)) {
            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('rua').value="...";
            document.getElementById('bairro').value="...";
            //Cria um elemento javascript.
            var script = document.createElement('script');
            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';
            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);
        }
        else {//cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    }
    else {limpa_formulário_cep();}
};