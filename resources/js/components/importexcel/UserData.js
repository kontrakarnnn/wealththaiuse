import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import ReactTable from 'react-table'
import 'react-table/react-table.css'
import Dialog from 'react-dialog'
import Picky from 'react-picky';
import 'react-picky/dist/picky.css'; // Include CSS
import Modal from 'react-awesome-modal';

export default class UserData extends Component {

  constructor(){
    super();
    this.state = {
      cases:[],
    };

  }

  componentDidMount(){
      axios.get('/admin/import_excel/userdata').then(response=>{
        this.setState({cases:response.data});
        console.log('cases'+response.data);
            }).catch(errors=>{
        //console.log(errors);
      })



  }
  rowclick(rowInfo){
    axios.post('/admin/import_excel/import/delete',{
      id:rowInfo,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        cases:res.data,
      })
    });
  }


    render() {

      return (


            <div>
        <ReactTable
            filterable
            previousText= 'ก่อนหน้า'
            nextText= 'ถัดไป'
            loadingText= 'กำลังโหลด'
            NoDataComponent={() => "Loading.."}
            data={this.state.cases}
            className="-striped -highlight"
            defaultPageSize={10}
            columns={[{

                          foldable: true,
                          columns: [{
                              Header: "id",
                              accessor: "id"
                            },{
                              Header: "username",
                              accessor: "username"
                            },{
                              Header: "firstname",
                              accessor: "firstname"
                            },{
                              Header: "lastname",
                              accessor: "lastname"
                            },{
                              Header: "email",
                              accessor: "email"
                            },
                            {
                              Header: 'status',
                              accessor: 'status',
                            },
                            {
                              Header: 'user_pid',
                              accessor: 'user_pid',
                            },
                            {
                              Header: 'limit_prospect',
                              accessor: 'limit_prospect',
                            },
                            {
                              Header: 'Action',
                              Cell: (rowInfo) => {
                                    return <div ><button onClick={() => { if (window.confirm('คุณต้องการลบ ?')) this.rowclick(rowInfo.row.id) } } type="button" class="btn btn-danger">Delete</button></div>;
                                  }
                            }]
                          }]
                      }

            /></div>
        );
    }
}

if (document.getElementById('userdata')) {
  const component = document.getElementById('userdata');
  const props = Object.assign({}, component.dataset);
    ReactDOM.render(<UserData {...props}/>, component);
}
