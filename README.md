<h1>Projeto Api Marvel</h1>
<h3>Sobre o Desafio</h3> 
<p>desenvolva uma aplicação que consuma a API da Marvel. Para isso, utilize a seguinte documentação: <a href="https://developer.marvel.com/docs">https://developer.marvel.com/docs</a>.</p>
<ul>
    <li>
        A aplicação deve ser desenvolvida em PHP (ao menos o back-end);
    </li>
    <li>
        O banco de dados preferencialmente, deve ser em MySQL;
    </li>
</ul>
<p>Esse software deve pegar as informações necessárias e armazená-las em um banco de dados para serem consumidas e apresentadas em tela.</p>
<p>O que é obrigatório ser armazenado e apresentado para cada herói?</p>
<ul>
    <li>
        Nome
    </li>
    <li>
        Imagem
    </li>
    <li>
        Descrição
    </li>
</ul>
<p>O que é obrigatório ser armazenado e apresentado para cada história do herói?</p>
<ul>
    <li> Título</li>
    <li> Descrição</li>
</ul>
<p>Caso deseje inserir mais informações, fique à vontade.</p>
<p>Requisitos:</p>
<ul>
    <li>Ter pelo menos 3 heróis</li>
    <li>Ter pelo menos 5 histórias de cada herói</li>
</ul>
<p>Requisitos do software:</p>
<ul>
    <li>A tela deve ser responsiva;</li>
    <li>A aplicação deve ser versionada no GitHub;</li>
    <li>O projeto deve possuir um README (documentação) com instruções de instalação e utilização, modelo do banco de dados, bem como quaisquer outras informações que você achar necessário;</li>
</ul>

<h3>Instalação da aplicação</h3>
<ul>
    <li>Na pasta que deseja criar o projeto rodar <code> git clone https://github.com/kabratz/marvelApi.git</code> que irá copiar os arquivos do projeto</li>
    <li>Criar o banco do dados localmente (códigos a seguir MySQL dentro do banco) <code>CREATE TABLE marvel</code></li>
    <li>Criar uma cópia do arquivo <code>.env.example</code>  renomenado para <code>.env</code></li>
    <li>Editar o arquivo <code>.env</code> e colocar as configurações de conexão com o banco (foi utilizado mysql no projeto, portanto, informado os valores conforme abaixo:)<br>
        <code>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE= marvel
DB_USERNAME=root
DB_PASSWORD=my_password_created</code>
    </li>
    <li>Dentro do projeto, rodar o código <code>php artisan serve</code> que rodará o servidor e mostrará o link local que está rodando. Deixar essa aba rodando</li>
    <li>Em uma outra aba de código, rodar<code>php artisan migrate</code> (se tiver algum dado no banco, para que ele seja LIMPADO, ou seja, iniciado do ZERO, acrescentar ao código <code>:fresh</code></li>
</ul>
<h3>Modelo do banco de dados</h3>
<img src="https://github.com/kabratz/marvelApi/blob/master/malvelModel.png">

<h3>Informações sobre a aplicação e utilização</h3>
<p>
    Ao entrar na aplicação, verá a página inicial. Não contendo Heróis e Histórias, os mesmos devem ser importados da api por meio da aplicação. Para isto, seguir a recomentação abaixo:
</p>
<ul>
    <li>No menu lateral (acessível pela esquerda do cabeçalho, no botão ☰) acessar Character (heróis) OU Stories(Histórias) </li>
    <li>Cada uma das respectivas páginas, possui um botão "Import All" (Importar todos), onde irá buscar todos as respectivas informações na API da Marvel (cada página irá importar suas informações)</li>
    <li>Ao importar, irá aparecer na página acessada os dados disponíveis, e clicando em cada um, abrirá mais detalhes</li>
    <li>Tendo dados no banco local, ao ir para a Home (acessada pelo menu ou pelo ícone da Marvel) irá aparecer um Breve resumo dos Heróis e Histórias (ou os que tiverem sido importados) </li>
    <li>A única diferença do catálogo de Heróis (Characters) para o de Histórias (Stories) é que na segunda, irá aparecer os heróis vinculados às histórias.</li>
    <li>Para um heróis ser vinculado à uma história, deve-se acessar as histórias (Stories), clicar na que deseja adicionar heróis, clicar em 'Add new Character" (adicionar novo herói), selecionar o herói que deseja adicionar e enviar (Submit). Após adicionado, ao clicar nos detalhes da história, irá aparecer os heróis vinculados</li>
    <li>Ao clicar nas informações das histórias, também é possível remover um herói, clican em "Remove Character" abaixo de cada herói nos detalhes da história</li>
</ul>
