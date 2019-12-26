<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ env('APP_NAME') }}</title>

        {{-- Bootstrap CSS --}}
        <!--  -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        {{-- Header --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand" href="#">
                <h2>
                    CRUD - Montar Site        
                </h3>
            </a>
        </nav>
        
        {{-- Body --}}
        <div class="container-fluid" id="app">

            <div class="row justify-content-center ">
                <div class="col-12 col-lg-6">
                    
                    {{-- navegation --}}
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-con" role="tab" aria-controls="nav-con" aria-selected="true">Consultar</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-insert" role="tab" aria-controls="nav-ins" aria-selected="false">Inserir</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-update" role="tab" aria-controls="nav-alt" aria-selected="false">Alterar</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-delete" role="tab" aria-controls="nav-del" aria-selected="false">Deletar</a>
                        </div>
                    </nav>

                    <div class="mt-5 tab-content border-top-0 border-secondary" id="nav-tabContent">

                        {{-- select --}}
                        <div class="tab-pane fade show active" id="nav-con" role="tabpanel" aria-labelledby="nav-home-tab">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Edição</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in users">
                                        <th scope="row">@{{ user.id }}</th>
                                        <th>@{{ user.name }}</th>
                                        <th>@{{ user.updated_at }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- insert --}}
                        <div class="tab-pane fade" id="nav-insert" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <form method="POST" action="/user/create" id="insert">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nome do usuário: </label>
                                    <input type="text" class="form-control" name="name" id="name" v-model="name">
                                </div>
                                <input type="button" class="btn btn-success" onclick="nameLastName()" value="Cadastrar">
                            </form>
                        </div>

                        {{-- update --}}
                        <div class="tab-pane fade" id="nav-update" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <form method="post" action="/user/update" id="update">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-12 col-md-6">
                                        <label for="userId">ID do usuário: </label>
                                        <select class="custom-select" id="userId" name="userId">
                                            <option value="" selected>Id</option>
                                            <option v-for="user in users" :value="user.id">@{{ user.id }} - @{{ user.name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mt-3 col-md-6 mt-md-0">
                                        <label for="userName">Novo nome: </label>
                                        <input type="text" class="form-control" id="userName" name="userName" placeholder="Nome">
                                    </div>
                                </div>

                                <input type="button" class="btn btn-warning" onclick="updateUser()" value="Atualizar">
                            </form>
                        </div>

                        {{-- delete --}}
                        <div class="tab-pane fade" id="nav-delete" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <form method="post" action="/user/delete" id="delete">
                                @csrf
                                <div class="form-group">
                                    <label for="idUser">Id do usuário: </label>
                                    <select class="custom-select" id="idUser" name="idUser">
                                        <option value="" selected>Id</option>
                                        <option v-for="user in users" :value="user.id">@{{ user.id }} - @{{ user.name }}</option>
                                    </select>
                                </div>
                                <input type="button" class="btn btn-danger" onclick="deleteUser()" value="Deletar">
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            {{-- errors --}}
            @if (count($errors) > 0)
                <div class="col-12">
                    <div class="alert alert-danger">
                        <span>{{ count($errors) }} erros encontrados. Verifique o formulário, e reenvie</span>
                        
                        @if ($errors->has('name'))
                            <p>Nome: <span class="">{{ $errors->first('name') }}</span></p>
                        @endif

                        @if ($errors->has('userName'))
                            <p>Nome: <span class="">{{ $errors->first('userName') }}</span></p>
                        @endif
                    </div>
                </div>
            @endif

        </div>

        {{-- bootstrap CDN --}}
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        
        {{-- VueJs and Axios CDN --}}
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

        <script>

            var app = new Vue({
                el: "#app", 

                data: {
                    users: [],
                    name: null,
                }, 

                mounted: function() {
                    axios
                        .get('/api/users')
                        .then(response => (this.users = response.data.data));

                        console.log(this.users);
                },
            });

            function nameLastName() {
                var name = document.getElementById("name").value;
                if (name == '') {
                    alert('Campo vazio');
                } else {
                    var names = name.split(" ");
                
                    if (names.length < 2) {
                        alert('Por favor, escrever nome e sobrenome');  
                    } else {
                        document.getElementById("insert").submit();
                    }
                }
            }

            function updateUser() {
                var name = document.getElementById("userName").value;
                var id = document.getElementById("userId").value;
                if (id == '' && name == '') {
                    alert('Campos vazios');
                } else if (name == '') {
                    alert('Nome vazio');
                } else if (id == '') {
                    alert('Escolha um id');
                } else {
                    var names = name.split(" ");
                
                    if (names.length < 2) {
                        alert('Por favor, escrever nome e sobrenome');  
                    } else {
                        document.getElementById("update").submit();
                    }
                }
            }

            function deleteUser() {
                var id = document.getElementById("idUser").value;
                if (id == '') {
                    alert('Escolha um id.');
                } else {
                    var answer = confirm("Você confirma a exclusão do usuário " + id + "?");
                    if (answer == true) {
                        document.getElementById("delete").submit();
                    }
                }
            }
        </script>
    </body>
</html>