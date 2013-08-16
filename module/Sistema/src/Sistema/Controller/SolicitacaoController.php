<?php
 
// namespace de localizacao ContatosController.php
namespace Sistema\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
 
class SolicitacaoController extends AbstractActionController
{
 
    // GET /solicitacao
    public function indexAction()
    {
        return array('message' => $this->getFlashMessenger());
    }
 
    // GET /solicitacao/novo
    public function novoAction()
    {
        return array('message' => $this->getFlashMessenger());
    }
 
// POST /solicitacao/adicionar
public function adicionarAction()
{
    // obtém a requisição
    $request = $this->getRequest();
 
    // verifica se a requisição é do tipo post
    if ($request->isPost()) {
        // obter e armazenar valores do post
        $postData = $request->getPost()->toArray();
        $formularioValido = false;
 
        // verifica se o formulário segue a validação proposta
        if ($formularioValido) {
            // aqui vai a lógica para adicionar os dados à tabela no banco
            // 1 - solicitar serviço para pegar o model responsável pela adição
            // 2 - inserir dados no banco pelo model
 
            // adicionar mensagem de sucesso
            $this->flashMessenger()->addSuccessMessage("Solicitação realizada com sucesso");
 
            // redirecionar para action index no controller solicitacao
            return $this->redirect()->toRoute('solicitacao');
        } else {
            // adicionar mensagem de erro
            $this->flashMessenger()->addErrorMessage("Erro ao solicitar veículo");
 
            // redirecionar para action novo no controllers solicitacao
            return $this->redirect()->toRoute('solicitacao', array('action' => 'novo'));
        }
    }
}
 
    // GET /solicitacao/detalhes/id
    public function detalheAction()
    {
    // filtra id passsado pela url
    $id = (int) $this->params()->fromRoute('id', 0);
 
    // se id = 0 ou não informado redirecione para solicitação
    if (!$id) {
        // adicionar mensagem de erro
        $this->flashMessenger()->addErrorMessage("Solicitação não encotrada");
 
        // redirecionar para action index
        return $this->redirect()->toRoute('solicitacao');
    }
 
    // aqui vai a lógica para pegar os dados referente à solicitação
    // 1 - solicitar serviço para pegar o model responsável pelo find
    // 2 - solicitar form com dados da solicitação encontrada
 
    // formulário com dados preenchidos
    $form = array(
        'solicitante'                  => 'CMTI',
        "destino"    => "Promotorias da Capital",
        "objetivo"   => "Apresentar sistema de ponto",
        "data_agendamento"          => "02/03/2013",
        "data_solicitacao"      => "02/03/2013",
    );
 
    // dados eviados para detalhes.phtml
    return array('id' => $id, 'form' => $form, 'message' => $this->getFlashMessenger());
    }
 
    // GET /solicitacao/editar/id
    public function editarAction()
    {
    // filtra id passsado pela url
    $id = (int) $this->params()->fromRoute('id', 0);
 
    // se id = 0 ou não informado redirecione para solicitacao
    if (!$id) {
        // adicionar mensagem de erro
        $this->flashMessenger()->addErrorMessage("Solicitação não encotrada");
 
        // redirecionar para action index
        return $this->redirect()->toRoute('solicitar');
    }
 
    // aqui vai a lógica para pegar os dados referente à solicitação
    // 1 - solicitar serviço para pegar o model responsável pelo find
    // 2 - solicitar form com dados da solicitação encontrado
 
    // formulário com dados preenchidos
    $form = array(
        'solicitante'                  => 'CMTI',
        "destino"                      => "Promotorias da Capital",
        "objetivo"                     => "Apresentar Sistema de ponto",
    );
 
    // dados eviados para editar.phtml
    return array('id' => $id, 'form' => $form, 'message' => $this->getFlashMessenger());
    }
 
    // PUT /solicitacao/editar/id
    public function atualizarAction()
    {
    // obtém a requisição
    $request = $this->getRequest();
 
    // verifica se a requisição é do tipo post
    if ($request->isPost()) {
        // obter e armazenar valores do post
        $postData = $request->getPost()->toArray();
        $formularioValido = true;
 
        // verifica se o formulário segue a validação proposta
        if ($formularioValido) {
            // aqui vai a lógica para editar os dados à tabela no banco
            // 1 - solicitar serviço para pegar o model responsável pela atualização
            // 2 - editar dados no banco pelo model
 
            // adicionar mensagem de sucesso
            $this->flashMessenger()->addSuccessMessage("Solicitação editada com sucesso");
 
            // redirecionar para action detalhes
            return $this->redirect()->toRoute('solicitacao', array("action" => "detalhe", "id" => $postData['id'],));
        } else {
            // adicionar mensagem de erro
            $this->flashMessenger()->addErrorMessage("Erro ao editar solicitação");
 
            // redirecionar para action editar
            return $this->redirect()->toRoute('solicitacao', array('action' => 'editar', "id" => $postData['id'],));
        }
    }

    }
 
    // DELETE /solicitacao/deletar/id
    public function deletarAction()
    {
    }

    // Filter Flash Messenger
    private function getFlashMessenger()
    {
        $messenger = array();
        $flashMessenger = $this->flashMessenger();

        if ($flashMessenger->hasSuccessMessages()) {
            $mensagens = $flashMessenger->getSuccessMessages();
            $messenger['alert-success'] = $mensagens[0];
        }

        if ($flashMessenger->hasErrorMessages()) {
            $mensagens = $flashMessenger->getErrorMessages();
            $messenger['alert-error'] = $mensagens[0];
        }

        return $messenger;
    }
 
}