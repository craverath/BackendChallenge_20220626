
# Backend Challenge 20220626
> challenge by [coodesh](https://coodesh.com/)

#### Contrução do projeto:

###### Para criar essa API, foi usado o Laravel com as seguintes bibliotecas:

- `guzzlehttp/guzzle`: Esta biblioteca facilita a fazer requisições HTTP a servidores. Ela é uma biblioteca completa e bem documentada que suporta uma ampla gama de recursos, incluindo requisições assíncronas, cURL, proxies e muito mais.
- `symfony/dom-crawler`: Esta biblioteca facilita a extração de dados de páginas da web. Ela permite que você navegue pelas páginas da web, selecione elementos e extraia o conteúdo deles.
- `symfony/css-selector`: Esta biblioteca facilita o uso de seletores CSS para selecionar elementos em páginas da web. Ela fornece uma série de métodos para selecionar elementos com base em seus atributos, classes e outros critérios.

Primeiro, criei os controllers e testei as rotas. Em seguida, criei o controller `Scrapping` que retorna um array com os dados de todos os produtos.
O banco de dados escolhido foi o MySQL e foi criado via `Migrate`. 
Esses dados são usados pelo `ProductsController` para adicionar os dados ao banco usando o Eloquent do Laravel. Dentro do próprio `ProductsController`, foram criados os métodos para consultar os dados usando o Model `Products`
O método e a classe responsável por inserir os dados no banco foram instanciados dentro do `app/console/Kernel` de forma que todos os dias às 2 da manhã aconteça o scrapping dos 100 produtos e sua inserção no banco de dados.



#### Instalação
Para executar a API, execute o comando `php artisan serve`

Para iniciar o agendamento, execute o comando `php artisan schedule:work`

A rota `/` retorna:

![image](https://github.com/craverath/BackendChallenge_20220626/assets/67438869/750daf44-5f6d-4957-b93e-e40ad3fbfa35)

A rota `/products` retorna:

![image](https://github.com/craverath/BackendChallenge_20220626/assets/67438869/777caa36-031a-4384-8c8d-46de9faa2099)

Com paginação, você pode acessar as outras páginas adicionando `?page=1`  ao final da URL ou clicando nos links para as páginas restantes no JSON.

A rota `/products/$id` retorna:

![image](https://github.com/craverath/BackendChallenge_20220626/assets/67438869/31a4eaf8-7ed4-4ee9-99f9-388ed3abdf9b)

Onde `$id` é o ID do produto a partir do qual os dados serão exibidos.
