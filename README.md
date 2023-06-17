<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>README - Executando Projeto Laravel a partir do Git</title>
</head>
<body>
    <h1>README - Executando Projeto Laravel a partir do Git</h1>
    <p>Este documento fornece um guia passo a passo para baixar e executar um projeto Laravel a partir do Git. Ele abrange desde o download do projeto até a configuração do ambiente e a execução do projeto no Laravel.</p>

    <h2>Passo 1: Baixando o projeto</h2>
    <ol>
        <li>Certifique-se de ter o Git instalado em seu ambiente de desenvolvimento. Caso não tenha, siga as instruções de instalação do Git para o seu sistema operacional.</li>
        <li>Abra o terminal ou prompt de comando e navegue até o diretório onde deseja baixar o projeto.</li>
        <li>Execute o seguinte comando para clonar o projeto a partir do repositório Git:</li>
    </ol>
    <pre><code>git clone https://github.com/MarceloJay/ApiRESTfull.git</code></pre>
    <p>Aguarde até que o Git termine de baixar o projeto para o diretório selecionado.</p>

    <h2>Passo 2: Configurando o ambiente</h2>
    <ol>
        <li>Certifique-se de ter o PHP e o Composer instalados em seu ambiente de desenvolvimento. Caso não tenha, siga as instruções de instalação do PHP e do Composer.</li>
        <li>Abra o terminal ou prompt de comando e navegue até o diretório do projeto Laravel que foi baixado.</li>
        <pre><code>cd ApiRESTfull</code></pre>
        <li>Execute o seguinte comando para instalar as dependências do projeto Laravel:</li>
    </ol>
    <pre><code>composer install</code></pre>
    <p>Gere a chave de criptografia do Laravel executando o seguinte comando:</p>

    <h2>Passo 3: Executando o projeto</h2>
    <ol>
        <li>No terminal ou prompt de comando, execute o seguinte comando para iniciar o servidor de desenvolvimento do Laravel:</li>
    </ol>
    <pre><code>php artisan serve</code></pre>
    <p>O projeto Laravel será executado no servidor de desenvolvimento e você poderá acessá-lo em seu navegador através da URL fornecida pelo comando anterior.</p>
    <p>Pronto! Agora você pode explorar e utilizar o projeto Laravel localmente.</p>

    <p>Certifique-se de estudar a documentação oficial do Laravel para obter mais informações detalhadas sobre o desenvolvimento e execução de projetos Laravel.</p>
</body>
</html>
