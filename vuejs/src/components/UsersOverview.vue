<template>
  <div class="UserOverview">
    <div class="container">
      <div class="row">
        <nav>       
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link" href="#/">dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#/users">gebruikers</a>
            </li>
          </ul>
        </nav>
      </div>
      <div class="bar">
        <div class="container">
          <div class="row">
            <b-button variant="primary" @click="openModalAddUser"><icon name="plus"></icon></b-button>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered table-hover">
            <thead class="thead-dark">
              <tr>
                <th>Gebruikersnaam</th>
                <th>Email adres</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Actief</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in users_data['body']['users']">
                <td>{{ user['name'] }}</td>
                <td>{{ user['email'] }}</td>
                <td><b-button variant="primary" @click="openModalEditUser(user['name'], user['email'])"><icon name="pencil"></icon></b-button></td>
                <td><icon name="trash"></icon></td>
                <td><icon name="check" class="text-success" v-if="user['active'] == '1'"></icon><icon v-else name="times" class="text-danger" ></icon></td>
              </tr>
              
            </tbody>
          </table>
          
        </div>

        <div id="app">
         
        </div>
      </div>

    </div>
    <div>
      <b-modal ref="editUser" id="edit_user" title="Gebruiker bewerken">
        <b-form-input v-model="name" type="text" placeholder="Vul een gebruikersNaam in"></b-form-input>
        <b-form-input v-model="email" type="text" placeholder="Vul een email in"></b-form-input>
      </b-modal>
    </div>
    <div>
      <b-modal ref="addUser" id="add_user" title="Gebruiker Toevoegen">
        <b-form-input v-model="name" id="name" name="email" type="text" placeholder="Vul een naam in"></b-form-input>
        <b-form-input v-model="username" id="username" name="username" type="text" placeholder="Vul een gebruikersNaam in"></b-form-input>
        <b-form-input class="form-control" value="" v-model="email" id="name" name="email" type="text" placeholder="Vul een email in"></b-form-input>
        <button id="update" @click="NewUserAction">Update</button>
        
      </b-modal>
    </div>
  </div>
</template>

<script>

export default {
  name: 'UserOverview',
  data () {
    return {
      users_data: 'UserOverview',
      email: '',
      name: '',
      debug: true
    }
  },
  created: function () {
    // `this` points to the vm instance
    this.$http.get('http://proboard/Users').then(response => {

      this.users_data = response;
      console.log(this.users_data['body']['users'])

    }, response => {
      this.users_data = 'failed';
    })
  },
  methods: {
    openModalEditUser (name, email) {
      this.email = email
      this.name = name
      this.$refs.editUser.show()
    },
    closeModalEditUser () {
      this.$refs.editUser.hide()
    },

    openModalAddUser(name,email){
      
      this.$refs.addUser.show()
    },
    closeModalAddUser(){
      this.$refs.AddUser.hide()
    },
    NewUserAction() {
      $.ajax({
        type:'POST',
        data: {
          email: this.email,
          name: this.name,
          username: this.username
        },
        url:'/users/NewUserAction',
        success:function(data) {
          // alert(this.data);
          alert("Gebruiker is toegevoegd");
        }
        });
     
    }
  }
}
</script>