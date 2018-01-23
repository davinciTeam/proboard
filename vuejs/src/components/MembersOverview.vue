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
                <td><b-button variant="primary" @click="openModalEditMember(member['ovnumber'], member['name'], member['insertion'], member['lastname'], member['slug'])"><icon name="pencil"></icon></b-button></td>
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
        <label>Ov-Nummer</label><b-form-input v-model="ovnumber" type="text" placeholder="Vul een Ov-Nummer in"></b-form-input>
        <label>Voornaam</label><b-form-input v-model="name" type="text" placeholder="Vul een Voornaam in"></b-form-input>
        <label>Tussenvoegsel</label><b-form-input v-model="insertion" type="text" placeholder="Vul een Tussenvoegsel in"></b-form-input>
        <label>Achternaam</label><b-form-input v-model="lastname"  type="text" placeholder="Vul een achternaam in"></b-form-input>
        <b-button class="mx-auto" variant="success" @click="closeModalEditMember">Opslaan</b-button>
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
      members: {},
      ovnumber: '',
      name: '',
      insertion: '',
      lastname: '',
      slug: ''
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
    openModalEditMember (ovnumber, name, insertion, lastname, slug) {
      this.ovnumber = ovnumber
      this.name = name
      this.insertion = insertion
      this.lastname = lastname
      this.slug = slug
      console.log(this.slug)
      this.$refs.editMember.show()
    },
    closeModalEditMember () {
      
      editMember(this.ovnumber, this.name, this.insertion, this.lastname, this.slug)
      this.$refs.editMember.hide()
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