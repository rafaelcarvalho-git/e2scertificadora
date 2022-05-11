// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
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
var search = document.getElementById('mes');
search.addEventListener("keydown", function(event) {
    if (event.key === "Enter") {searchData();}
});
function searchData() {window.location = 'solicitacoes_ativas.php?search='+search.value;}

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
    else { //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
};


