<?php

return [
    'register' => [
        'register' => 'Registrar',
        'already_registered' => 'Já registrado?',
    ],

    'verify_email' => [
        'info' => 'Obrigado por se inscrever! Antes de começar, você poderia verificar seu endereço de e-mail clicando no link que acabamos de enviar para você? Se você não recebeu o e-mail, teremos prazer em enviar outro.',
        'verification_link_sent' => 'Um novo link de verificação foi enviado para o endereço de e-mail que você forneceu durante o registro.',
        'resend_email' => 'Reenviar E-mail de Verificação',
        'logout' => 'Sair',
    ],

    'login' => [
        'remember' => 'Lembrar-me',
        'signin' => 'Entrar',
        'forgot_password' => 'Esqueceu sua senha?',
        'register' => 'Criar uma conta',
    ],

    'forgot_password' => [
        'info' => 'Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e nós enviaremos um link de redefinição de senha para que você possa escolher uma nova.',
        'reset_link' => 'Enviar Link de Redefinição de Senha',
        'return_login' => 'Voltar ao login',
        'reset_password' => 'Redefinir Senha',
    ],

    'confirm_password' => [
        'info' => 'Esta é uma área segura do aplicativo. Por favor, confirme sua senha antes de continuar.',
        'confirm' => 'Confirmar',
    ],

    'dashboard' => [
        'page_title' => 'Painel',
        'welcome' => 'Você está logado!',
    ],

    'profile' => [
        'page_title' => 'Perfil',
        'edit' => [
            'title' => 'Informações do Perfil',
            'info' => 'Atualize as informações do perfil e o endereço de e-mail da sua conta.',
            'unverified_email' => 'Seu endereço de e-mail não está verificado.',
            'resend_email' => 'Clique aqui para reenviar o e-mail de verificação.',
            'resend_info' => 'Um novo link de verificação foi enviado para o seu endereço de e-mail.',
        ],
        'password' => [
            'title' => 'Atualizar Senha',
            'info' => 'Certifique-se de que sua conta está usando uma senha longa e aleatória para se manter segura.',
            'unverified_email' => 'Seu endereço de e-mail não está verificado.',
            'resend_email' => 'Clique aqui para reenviar o e-mail de verificação.',
            'resend_info' => 'Um novo link de verificação foi enviado para o seu endereço de e-mail.',
        ],
        'delete' => [
            'title' => 'Deletar Conta',
            'info' => 'Uma vez que sua conta for deletada, todos os seus recursos e dados serão permanentemente excluídos. Antes de deletar sua conta, por favor, faça o download de quaisquer dados ou informações que você deseje reter.',
            'delete_account' => 'Deletar Conta',
            'confirm' => 'Tem certeza de que deseja deletar sua conta?',
            'confirm_info' => 'Uma vez que sua conta for deletada, todos os seus recursos e dados serão permanentemente excluídos. Por favor, insira sua senha para confirmar que você deseja excluir permanentemente sua conta.',
        ],
    ],

    'users' => [
        'index' => [
            'page_title' => 'Usuários',
            'add_user' => 'Novo Usuário',
            'not_found' => 'Nenhum registro encontrado',
        ],
        'create' => [
            'page_title' => 'Criar Usuário',
            'info' => 'Criar um novo usuário',
            'description' => 'Preencha os campos obrigatórios e clique em salvar',
            'success' => 'Usuário cadastrado.',
        ],
        'show' => [
            'page_title' => 'Visualizar Usuário',
            'info' => 'Informações do Usuário',
            'description' => 'Visualizar os detalhes do usuário.',
        ],
        'edit' => [
            'page_title' => 'Editar Usuário',
            'info' => 'Editar as informações do usuário',
            'description' => 'Preencha os campos obrigatórios e clique em salvar',
            'success' => 'Usuário atualizado.',
        ],
        'delete' => [
            'confirm_delete_title' => 'Por favor confirme',
            'confirm_delete_message' => 'Tem certeza de que deseja excluir o usuário?',
            'error' => 'Action not permitted',
            'success' => 'Usuário excluído.',
        ],
    ],

    'roles' => [
        'index' => [
            'page_title' => 'Funções',
            'add_role' => 'Nova Função',
            'not_found' => 'Nenhum registro encontrado',
        ],
        'create' => [
            'page_title' => 'Criar Função',
            'description' => 'Preencha os campos obrigatórios e clique em salvar',
            'success' => 'Função cadastrada.',
        ],
        'edit' => [
            'page_title' => 'Editar Função',
            'success' => 'Função atualizada.',
        ],
        'delete' => [
            'confirm_delete_title' => 'Por favor confirme',
            'confirm_delete_message' => 'Tem certeza de que deseja excluir a função?',
            'success' => 'Função excluída.',
        ],
    ],

    'menus' => [
        'dashboard' => 'Painel',
        'users' => 'Usuários',
        'roles' => 'Funções',
        'profile' => 'Perfil',
        'logout' => 'Sair',
    ],

    'fields' => [
        'id' => 'ID',
        'name' => 'Nome',
        'email' => 'E-mail',
        'password' => 'Senha',
        'confirm_password' => 'Confirmar Senha',
        'current_password' => 'Senha Atual',
        'new_password' => 'Nova Senha',
        'roles' => 'Funções',
        'created_at' => 'Criado em',
        'photo' => 'Foto',
    ],

    'common' => [
        'search' => 'Pesquisar',
        'show' => 'Detalhes',
        'edit' => 'Editar',
        'cancel' => 'Cancelar',
        'save' => 'Salvar',
        'saved' => 'Salvo',
        'delete' => 'Excluir',
        'previous' => 'Anterior',
        'next' => 'Próximo',
        'actions' => 'Ações',
        'back' => 'Voltar',
        'password_info_1'=> '* A senha deve ter pelo menos 8 caracteres',
        'password_info_2'=> '* Combinação de letras maiúsculas, minúsculas e números',
        'password_info_3'=> '* Uso de caracteres especiais',
    ],
];
