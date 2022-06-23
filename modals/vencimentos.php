<!-- Janela Confirma Sair do Sistema (logout) -->
<div class="modal fade" id="vencimentos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Vencimentos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <table class="table table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Cliente</th>
                <th scope="col">Telefone</th>
                <th scope="col">Certificado</th>
                <th scope="col">Data do Vencimento</th>
                <th scope="col">Contador</th>
            </tr>
            </thead>
            <tbody><?php while($rows_solicitacoes = mysqli_fetch_assoc($solicitacoes)){ ?>
            <tr>
                <td><?php echo base64_decode($rows_solicitacoes['nome']); ?></td>
                <td><?php echo base64_decode($rows_solicitacoes['telefone']); ?></td>
                <td><?php echo $rows_solicitacoes['tipo_certificado']; ?></td>        
                <td><?php echo $rows_solicitacoes['data_solicitacao']; ?></td>                         
                <td><?php echo base64_decode($rows_solicitacoes['contador']); ?></td>
            </tr><?php } ?>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="sair.php"><button type='button' class='btn btn-primary'>Sair</button></a> 
    </div>
    </div>
</div>
</div>