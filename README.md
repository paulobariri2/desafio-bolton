Desafio Bolton
==============

Este projeto possui um arquivo docker-compose.yml para a criação de três containers: apache, php e mysql.
O container mysql é responável pelo banco de dados. O container apache é responsável por receber as chamadas REST. Neste container é configurado um proxy para enviar as requisições de arquivos PHP para o container php. Esse proxy é configurado pelo arquivo 'apache/bolton.apache.conf' que define um host virtual (VirtualHost).
Os códigos PHP desenvolvidos encontram-se na pasta 'app'. 

###Subindo os servidores
Para utilizar este projeto, deve-se subir os servidores de cada container utilizando o comando a seguir.

```
docker-compose up
```

###Salvando os dados das Notas Fiscais no banco de dados
Para obter os dados das notas fiscais e salvá-los no banco de dados basta fazer uma chamada REST para o host da máquina executando os servidores. O arquivo 'index.php' vai realizar uma chamada para a API disponibilizada pela Arquivei, obter o valor da nota fiscal e salvá-lo no banco de dados junto com a chave de acesso da respectiva nota, na tabela 'nfevalue'.

###Recuperando o valor de uma nota fiscal
Foi implementada uma API para receber um valor de chave de acesso de uma nota fiscal, acessar o banco de dados e recuperar o valor dessa nota fiscal. Essa API foi implementada no arquivo 'app/api/retrieve_value.php'. Para obter o valor de uma nota fiscal armazenada no banco de dados basta realizar uma chamada REST para http://<host>/api/retrieve_value.php informando o valor da chave de acesso no parâmetro 'access_key'. Segue um exemplo de request cURL caso a chamada seja realizada a partir da mesma máquina na qual os servidores estão executando. Caso contrário, basta substituir 'localhost' pelo host apropriado.

```
curl -X GET http://localhost/api/retrieve_value.php?access_key=<valor da chave de acesso>
```
