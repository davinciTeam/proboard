<template>
  <div class="UserOverview">
    <div class="container">
      <div class="row">
        <navigation></navigation>
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
              <tr v-for="user in users_data['users']">
                <td>{{ user['name'] }}</td>
                <td>{{ user['email'] }}</td>
                <td><b-button variant="primary" @click="openModalEditUser(user['name'], user['email'], user['id'])"><icon name="pencil"></icon></b-button></td>
                <td><icon name="trash"></icon></td>
                <td><icon name="check" class="text-success" v-if="user['active'] == '1'"></icon><icon v-else name="times" class="text-danger" ></icon></td>
              </tr>
              
            </tbody>
          </table>
          
        </div>
      </div>

    </div>
    <div>
      <b-modal hide-footer=true ref="editUser" id="edit_user" title="Gebruiker bewerken">
        <label>gebruikersnaam</label><b-form-input v-model="name" type="text" placeholder="Vul een gebruikersNaam in"></b-form-input>
        <label>email</label><b-form-input v-model="email" type="text" placeholder="Vul een email in"></b-form-input>
        <b-button class="mx-auto" variant="success" @click="closeModalEditUser">Opslaan</b-button>
      </b-modal>
    </div>
    <div>
      <b-modal hide-footer=true ref="addUser" id="add_user" title="Gebruiker Toevoegen">
        <b-form-input v-model="name" id="name" name="email" type="text" placeholder="Vul een naam in"></b-form-input>
        <b-form-input v-model="username" id="username" name="username" type="text" placeholder="Vul een gebruikersNaam in"></b-form-input>
        <b-form-input class="form-control" value="" v-model="email" id="email" name="email" type="text" placeholder="Vul een email in"></b-form-input>
        <b-button class="mx-auto" variant="success" @click="closeModalAddUser">Toevoegen</b-button>
        
      </b-modal>
    </div>
  </div>
</template>

<script>

import {GetAllUsers, editUser, NewUserAction} from '../utils/users';

export default {
  name: 'UserOverview',
  data () {
    return {
      users_data: '',
      email: '',
      name: '',
      debug: true,
      id: ''
    }
  },
  created() {
    GetAllUsers().then(response => {
      this.users_data = response.data
    }).catch(err => {
      console.log(err);
    })
  },
  methods: {
    openModalEditUser (name, email, id) {
      this.email = email
      this.name = name
      this.id = id
      console.log(this.id)
      this.$refs.editUser.show()
    },
    closeModalEditUser () {
      
      editUser(this.id, this.name, this.email)
      this.$refs.editUser.hide()
    },

    openModalAddUser(){
      
      this.$refs.addUser.show()
    },
    closeModalAddUser(){
      NewUserAction(this.email, this.name, this.username)
      this.email = "";
      this.name = "";
      this.username = "";
      this.$refs.addUser.hide()
    }
  }
}
</script>