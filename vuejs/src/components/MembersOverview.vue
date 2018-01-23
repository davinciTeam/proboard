<template>
  <div class="MembersOverview">
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
                <th>Ov-nummer</th>
                <th>Naam</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Actief</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="member in members['members']">
                <td>{{ member['ovnumber'] }}</td>
                <td>{{ member['name'] }} {{member['insertion']}} {{member['lastname']}}</td>
                <td><b-button variant="primary" @click="openModalEditMember(member['name'], member['email'], member['id'])"><icon name="pencil"></icon></b-button></td>
                <td>Delete</td>
                <td><icon name="check" class="text-success" v-if="member['active'] == '1'"></icon><icon v-else name="times" class="text-danger" ></icon></td>
              </tr>
              
            </tbody>
          </table>
          
        </div>
      </div>

    </div>
    <div>
      <b-modal hide-footer=true ref="editMember" id="edit_member" title="Lid bewerken">
        <label>gebruikersnaam</label><b-form-input  type="text" placeholder="Vul een gebruikersNaam in"></b-form-input>
        <label>email</label><b-form-input  type="text" placeholder="Vul een email in"></b-form-input>
        <b-button class="mx-auto" variant="success" @click="closeModalEditUser">Opslaan</b-button>
      </b-modal>
    </div>
    <div>
      <b-modal hide-footer=true ref="addMember" id="add_member" title="Lid Toevoegen">
        <b-form-input  id="name" name="email" type="text" placeholder="Vul een naam in"></b-form-input>
        <b-form-input  id="username" name="username" type="text" placeholder="Vul een gebruikersNaam in"></b-form-input>
        <b-form-input class="form-control" value=""  id="email" name="email" type="text" placeholder="Vul een email in"></b-form-input>
        <b-button class="mx-auto" variant="success" @click="closeModalAddUser">Toevoegen</b-button>
        
      </b-modal>
    </div>
  </div>
</template>

<script>

import {GetAllMembers, editMember, NewMemberAction} from '../utils/members';

export default {
  name: 'MembersOverview',
  data () {
    return {
      members: {}
    }
  },
  created() {
    GetAllMembers().then(response => {
      this.members = response.data
    }).catch(err => {
      console.log(err);
    })
  },

  methods: {
    openModalEditUser () {
    //   this.email = email
    //   this.name = name
    //   this.id = id
    //   console.log(this.id)
    //   this.$refs.editUser.show()
    },
    closeModalEditUser () {
      
    //   editUser(this.id, this.name, this.email)
    //   this.$refs.editUser.hide()
    },

    openModalAddUser(){
      
      // this.$refs.addUser.show()
    },
    closeModalAddUser(){
      // NewMemberAction(this.email, this.name, this.username)
      // this.email = "";
      // this.name = "";
      // this.username = "";
      // this.$refs.addUser.hide()
    }
  }
}
</script>