import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import ReactTable from 'react-table'
import 'react-table/react-table.css'
import Dialog from 'react-dialog'
import Picky from 'react-picky';
import 'react-picky/dist/picky.css'; // Include CSS
import Modal from 'react-awesome-modal';

export default class InsuranceAllcase extends Component {

  constructor(){
    super();
    this.state = {
      cases:[],
    };

    this.rowclick = this.rowclick.bind(this);
    this.showcase = this.showcase.bind(this);

  }

  componentDidMount(){

    //console.log(window.location.href);
    const url = window.location.href;
    if(url.includes('?filterstage') == true)
    {
      const split2 = url.split('?filterstage');
      //console.log(split2[1])
      //console.log("hi")
      axios.get('/wealththaiinsurance/cases/load?filterstage'+split2[1]).then(response=>{
        this.setState({cases:response.data});
          //console.log('cases'+response.data);
      }).catch(errors=>{
        //console.log(errors);
      })
    }
    else
    {
      axios.get('/wealththaiinsurance/cases/load').then(response=>{
        this.setState({cases:response.data});
          //console.log('cases');
      }).catch(errors=>{
        //console.log(errors);
      })
    }


  }
  showcase(e)
  {
    if(e.target.checked == true)
    {
      const url = window.location.href;
      if(url.includes('?filterstage') == true)
      {
        const split2 = url.split('?filterstage');
        //console.log(split2[1])
        //console.log("hi")
        axios.get('/wealththaiinsurance/cases/load?alludb=1?filterstage'+split2[1]).then(response=>{
          this.setState({cases:response.data});
            console.log('cases'+response.data);
        }).catch(errors=>{
          //console.log(errors);
        })
      }
      else
      {
        axios.get('/wealththaiinsurance/cases/load?alludb=1').then(response=>{
          this.setState({cases:response.data});
            console.log(response.data);
        }).catch(errors=>{
          //console.log(errors);
        })
      }
    }
    else
    {
      const url = window.location.href;
      if(url.includes('?filterstage') == true)
      {
        const split2 = url.split('?filterstage');
        //console.log(split2[1])
        //console.log("hi")
        axios.get('/wealththaiinsurance/cases/load?filterstage'+split2[1]).then(response=>{
          this.setState({cases:response.data});
            //console.log('cases'+response.data);
        }).catch(errors=>{
          //console.log(errors);
        })
      }
      else
      {
        axios.get('/wealththaiinsurance/cases/load').then(response=>{
          this.setState({cases:response.data});
            console.log(response.data);
        }).catch(errors=>{
          //console.log(errors);
        })
      }
    }
    console.log(e.target.checked)
  }
  rowclick(rowInfo){
    ////console.log(rowInfo.row.id);
    window.open('/wealththaiinsurance/cases/'+rowInfo.row.id+'/detail/show','_self');
  }

    render() {

      return (
            <div>

            <div>   <a style={{fontSize:'16px'}}href="/wealththaiinsurance/all/case/stage" className="btn btn-primary btn-margin">กลับไปหน้าหลัก</a>  <a style={{fontSize:'16px'}} className="btn btn-warning btn-margin" href="/wealththaiinsurance/all/searchcase" >ไปหน้าค้นหาข้อมูล</a><br/><br/>
            <label class="checkbox-inline"><input   class="subject-list memtype" type="checkbox" onChange={this.showcase}/>ดูงานทั้งหมดที่มีสิทธิ</label>
        <ReactTable
            filterable
            previousText= 'ก่อนหน้า'
            nextText= 'ถัดไป'
            loadingText= 'กำลังโหลด'
            NoDataComponent={() => "Loading.."}
            data={this.state.cases}
            getTrProps={(state, rowInfo) => ({
                      onClick: () =>this.rowclick(rowInfo)
                    })}
            className="-striped -highlight"
            columns={[{
                          Header: <p style={{fontSize:'18px'}}>ข้อมูลงาน</p>,

                          foldable: true,
                          columns: [{
                              Header: "รหัส",
                              accessor: "id"
                            },{
                              Header: "ประเภทงาน",
                              accessor: "case_type.name"
                            },{
                              Header: "ชื่องาน",
                              accessor: "name"
                            },{
                              Header: "สถานะ",
                              accessor: "case_status.name"
                            },{
                              Header: "ช่องทางรับงาน",
                              accessor: "case_channel.name"
                            },
                            {
                              Header: 'วันที่รับงาน',
                              accessor: 'case_created_date',
                            }]
                          },{
                          Header: <p style={{fontSize:'18px'}}>บุคคลเกี่ยวข้องกับงาน</p>,
                          foldable: true,
                          columns: [
                            {
                              Header: 'ผู้แจ้งงาน',
                              accessor: 'block.name',
                            },{
                              Header: "ผู้ประสานงาน",
                              accessor: "coordiantor.firstname"
                           },{
                             Header: "ผู้ให้คำปรึกษา",
                             accessor: "partner_block.name"
                          }]
                        },{
                        Header: <p style={{fontSize:'18px'}}>ข้อมูลลูกค้า</p>,
                        foldable: true,
                        columns: [{
                            Header: "ชื่อ",
                            accessor: "person.name"
                          },{
                            Header: "นามสกุล",
                            accessor: "person.lname"
                         }
                        ]
                      },{
                      Header: <p style={{fontSize:'18px'}}>ข้อมูลทรัพย์สินของลูกค้า</p>,
                      foldable: true,
                      columns: [{
                          Header: "ชื่อ",
                          accessor: "asset.name"
                        },{
                          Header: "ทะเบียน",
                          accessor: "asset.ref_name"
                       }
                      ]
                    }]
                      }

            /></div></div>
        );
    }
}

if (document.getElementById('insuranceallcase')) {
    ReactDOM.render(<InsuranceAllcase />, document.getElementById('insuranceallcase'));
}
