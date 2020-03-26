import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import DatePicker from 'react-datepicker';
import moment from 'moment';
import 'react-datepicker/dist/react-datepicker.css';
import Select from 'react-select';
export default class Insurance extends Component {
  constructor(){
    super();
    //console.log(super());
    this.state = {
      news:[],
      user:[],
      coordinate:[],
      partner:[],
      casechannel:[],
      name:'',
      country_code:'',


    };

    this.handleChangeCountrycode = this.handleChangeCountrycode.bind(this);
    this.handleChangeName = this.handleChangeName.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);


  }


  handleChangeName(e){
    console.log(e.target.value);
    this.setState({
      name:e.target.value,
    })
  }

  handleChangeCountrycode(e){
    console.log(e.target.value);
    this.setState({
      country_code:e.target.value,
    })
  }

  handleSubmit(e){
    e.preventDefault();
    axios.post('/admin/addCountry',{
      name:this.state.name,
      country_code:this.state.country_code
    }).then(res=>{

      console.log(res.data);
      this.setState({
        news:res.data
      })
    });
    console.log(e.target.value);
    this.setState({
      country_code:e.target.value,
    })
  }



  componentDidMount(){
    axios.get('/wealththaiinsurance/load/user').then(response=>{
      this.setState({user:response.data});
        console.log('user');
    }).catch(errors=>{
      console.log(errors);
    })
    axios.get('/wealththaiinsurance/load/coordinate').then(response=>{
      this.setState({coordinate:response.data});
        console.log('coordinate');
    }).catch(errors=>{
      console.log(errors);
    })
    axios.get('/wealththaiinsurance/load/partner').then(response=>{
      this.setState({partner:response.data});
        console.log('partner');
    }).catch(errors=>{
      console.log(errors);
    })
    axios.get('/wealththaiinsurance/load/casechannel').then(response=>{
      this.setState({casechannel:response.data});
        console.log('casechannel');
    }).catch(errors=>{
      console.log(errors);
    })
  }

    render() {

        return (
            <div class="column">
                <div class="card">
                    <div class="card-header">Step 1 ผู้แจ้งงานและผู้ประสานงาน</div>
                        <div class="card-body">
                        <table >

                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th style={{width: '200px'}}>ผู้แจ้งงาน</th>
                        <td ><div >

                          <select style={{width: '190px'}} class="selectwidthauto name" name="group_member[]">
                            <option value="0" >-Select-</option>
                            {
                              this.state.user.map(
                                data =>
                                <option value={data.id} >
                                {data.name}
                              </option>
                              )
                            }
                          </select>

                        </div></td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th style={{width: '200px'}}>ผู้ประสานงาน</th>
                        <td ><div >
                          <select style={{width: '190px'}} class="selectwidthauto name" name="group_member[]">
                            <option value="0" >-Select-</option>
                            {
                              this.state.coordinate.map(
                                data =>
                                <option value={data.id} >
                                {data.firstname}
                              </option>
                              )
                            }
                          </select>

                        </div></td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th style={{width: '200px'}}>ผู้ให้คำปรึกษา</th>
                        <td ><div >
                          <select style={{width: '190px'}} class="selectwidthauto name" name="group_member[]">
                            <option value="0" >-Select-</option>
                            {
                              this.state.partner.map(
                                data =>
                                <option value={data.id} >
                                {data.name}
                              </option>
                              )
                            }
                          </select>

                        </div></td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th style={{width: '200px'}}>เส้นทางรับงาน</th>
                        <td ><div >
                          <select style={{width: '190px'}} class="selectwidthauto name" name="group_member[]">
                            <option value="0" >-Select-</option>
                            {
                              this.state.casechannel.map(
                                data =>
                                <option value={data.id} >
                                {data.name}
                              </option>
                              )
                            }
                          </select>

                        </div></td>
                        </tr>

                        </table>


                        </div>
                        </div>
                        </div>

        );
    }
}

if (document.getElementById('insurance')) {
    ReactDOM.render(<Insurance />, document.getElementById('insurance'));
}
