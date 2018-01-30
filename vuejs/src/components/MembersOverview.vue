<template>
  <div class="MembersOverview">
    <div class="container">
      <div class="row">
        <navigation></navigation>
      </div>
      <div class="bar">
        <div class="container">
          <div class="row">
            <b-button variant="primary" @click="openModalAddMember"><icon name="plus"></icon></b-button>
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
        <b-form-input v-model="ovnumber"  id="ovnumber" name="ovnumber" type="text" placeholder="Vul een ovnumber in"></b-form-input>
        <b-form-input v-model="name" id="name" name="name" type="text" placeholder="Vul een naam in"></b-form-input>
        <b-form-input v-model="insertion" id="insertion" name="insertion" type="text" placeholder="Vul een Tussenvoegsel in"></b-form-input>
        <b-form-input v-model="lastname" class="form-control"  id="lastname" name="lastname" type="text" placeholder="Vul een achernaam in"></b-form-input>
        <b-button class="mx-auto" variant="success" @click="closeModalAddMember">Toevoegen</b-button>
        
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
      members: '',
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
  /*OpenModalEditMember
  Open a popbox with a four input fields where the current data of the selected member is shown

  this.ovnumber = ovnumber of the selected member
  this.name = name of the selected member
  this.slug = name of the member to create a link(Already exist)
  this.insertion = Insertion of the selected member
  this.lastname = lastname of the selected member
  */

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

    openModalAddMember(){
      
      this.$refs.addMember.show()
    },
    closeModalAddMember(){
      NewMemberAction(this.ovnumber, this.name, this.insertion, this.lastname)
      this.ovnumber = "";
      this.name = "";
      this.insertion = "";
      this.lastname = "";
      this.$refs.addMember.hide()
    }
  }
}
</script>