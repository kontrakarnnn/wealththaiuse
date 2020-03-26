import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import ReactTable from 'react-table'
import 'react-table/react-table.css'
import Dialog from 'react-dialog'
import Picky from 'react-picky';
import 'react-picky/dist/picky.css'; // Include CSS
import Modal from 'react-awesome-modal';
import RTChart from 'react-rt-chart';
import Select from 'react-select';
import ReactHTMLTableToExcel from 'react-html-table-to-excel';
import jsPDF from "jspdf";

export default class OfferAct extends Component {

  constructor(){
    super();
    ////console.log(super());
    this.state = {
      day:[],
      month:[],
      year:[],
      showall:'box collapsed-box',
      flagfixins38:0,
      fixins38:'',
      defaultvarvalue38:'',
      flagfixins39:0,
      fixins39:'',
      defaultvarvalue39:'',
      flagfixins40:0,
      fixins40:'',
      defaultvarvalue40:'',
      day40:'',
      month40:'',
      year40:'',
      flagfixins51:0,
      fixins51:'',
      defaultvarvalue51:'',
      flagfixins12:0,
      fixins12:'',
      defaultvarvalue12:'',
      flagfixins15:0,
      fixins15:'',
      defaultvarvalue38:'',
      varvalue51day:'',varvalue51month:'',varvalue51year:'',
      varvalue12day:'',varvalue12month:'',varvalue12year:'',
      varvalue15day:'',varvalue15month:'',varvalue15year:'',
    };
    this.openfixins38= this.openfixins38.bind(this);
    this.closefixins38= this.closefixins38.bind(this);
    this.handleChangefixins38= this.handleChangefixins38.bind(this);
    this.handleSubmitfixins38= this.handleSubmitfixins38.bind(this);
    this.openfixins39= this.openfixins39.bind(this);
    this.closefixins39= this.closefixins39.bind(this);
    this.handleChangefixins39= this.handleChangefixins39.bind(this);
    this.handleSubmitfixins39= this.handleSubmitfixins39.bind(this);
    this.openfixins40= this.openfixins40.bind(this);
    this.closefixins40= this.closefixins40.bind(this);
    this.handleChangefixins40= this.handleChangefixins40.bind(this);
    this.handleSubmitfixins40= this.handleSubmitfixins40.bind(this);
    this.openfixins51= this.openfixins51.bind(this);
    this.closefixins51= this.closefixins51.bind(this);
    this.handleChangefixins51= this.handleChangefixins51.bind(this);
    this.handleSubmitfixins51= this.handleSubmitfixins51.bind(this);
    this.openfixins12= this.openfixins12.bind(this);
    this.closefixins12= this.closefixins12.bind(this);
    this.handleChangefixins12= this.handleChangefixins12.bind(this);
    this.handleSubmitfixins12= this.handleSubmitfixins12.bind(this);
    this.openfixins15= this.openfixins15.bind(this);
    this.closefixins15= this.closefixins15.bind(this);
    this.handleChangefixins15= this.handleChangefixins15.bind(this);
    this.handleSubmitfixins15= this.handleSubmitfixins15.bind(this);
  }
  componentDidMount() {

    const url = window.location.href;
    if(url.includes('?mode=open') == true)
    {
        this.setState({showall:'box'});
    }
    else
    {
      this.setState({showall:'box collapsed-box'});
    }
    axios.get('/wealththaiinsurance/load/day').then(response=>{
      this.setState({day:response.data});
    })
    axios.get('/wealththaiinsurance/load/month').then(response=>{
      this.setState({month:response.data});
    })
    axios.get('/wealththaiinsurance/load/year').then(response=>{
      this.setState({year:response.data});
    })
    this.setState({
      defaultvarvalue15:this.props.varvalue15,
      defaultvarvalue51:this.props.varvalue51,
      defaultvarvalue12:this.props.varvalue12,
      defaultvarvalue38:this.props.varvalue38,
      defaultvarvalue39:this.props.varvalue39,
      defaultvarvalue40:this.props.varvalue40,
    })
  }
  handleSubmitfixins15(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins15',{
      id:this.props.id,
      fixins15:this.state.varvalue15day+'/'+this.state.varvalue15month+'/'+this.state.varvalue15year,
    }).then(res=>{

      //console.log(res.data);
      this.setState({
        defaultvarvalue15:this.state.varvalue15day+'/'+this.state.varvalue15month+'/'+this.state.varvalue15year,
        flagfixins15:0,
      })
    });
  }
  handleChangefixins15(e){
    //console.log(e.target.value);
    this.setState({
      fixins15:e.target.value,
    })
  }
  openfixins15()
  {
    this.setState({
      flagfixins15:1
    })
  }
  closefixins15()
  {
    this.setState({
      flagfixins15:0
    })
  }
  fixins15()
  {
    if(this.state.flagfixins15 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins15}><tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
       <th style={{backgroundColor:'white'}}>
       <select onChange={(e) => this.setState({ varvalue15day: e.target.value })} name="dayex">
       <option value ="">  วัน  </option>
       <option value ="01" selected={this.state.varvalue15day == '01' ? 'selected' : ''}>  01  </option>
       <option value ="02" selected={this.state.varvalue15day == '02' ? 'selected' : ''}>  02  </option>
       <option value ="03" selected={this.state.varvalue15day == '03' ? 'selected' : ''}>  03  </option>
       <option value ="04" selected={this.state.varvalue15day == '04' ? 'selected' : ''}>  04  </option>
       <option value ="05" selected={this.state.varvalue15day == '05' ? 'selected' : ''}>  05  </option>
       <option value ="06" selected={this.state.varvalue15day == '06' ? 'selected' : ''}>  06  </option>
       <option value ="07" selected={this.state.varvalue15day == '07' ? 'selected' : ''}>  07  </option>
       <option value ="08" selected={this.state.varvalue15day == '08' ? 'selected' : ''}>  08  </option>
       <option value ="09" selected={this.state.varvalue15day == '09' ? 'selected' : ''}>  09  </option>          {
         this.state.day.map(
           data =>
           <option value={data} selected={this.state.varvalue15day == data ? 'selected' : ''}>{data}</option>
         )
         }
         </select>

         <select  onChange={(e) => this.setState({ varvalue15month: e.target.value })}>
         <option value ="">  เดือน  </option>
         <option value ="01"  selected={this.state.varvalue15month == '01' ? 'selected' : ''}>  01  </option>
         <option value ="02"  selected={this.state.varvalue15month == '02' ? 'selected' : ''}>  02  </option>
         <option value ="03"  selected={this.state.varvalue15month == '03' ? 'selected' : ''}>  03  </option>
         <option value ="04"  selected={this.state.varvalue15month == '04' ? 'selected' : ''}>  04  </option>
         <option value ="05"  selected={this.state.varvalue15month == '05' ? 'selected' : ''}>  05  </option>
         <option value ="06"  selected={this.state.varvalue15month == '06' ? 'selected' : ''}>  06  </option>
         <option value ="07"  selected={this.state.varvalue15month == '07' ? 'selected' : ''}>  07  </option>
         <option value ="08"  selected={this.state.varvalue15month == '08' ? 'selected' : ''}>  08  </option>
         <option value ="09"  selected={this.state.varvalue15month == '09' ? 'selected' : ''}>  09  </option>
         {
           this.state.month.map(
             data =>
             <option value={data}  selected={this.state.varvalue15month == data ? 'selected' : ''}>{data}</option>
           )
          }
         </select>
       <select onChange={(e) => this.setState({ varvalue15year: e.target.value })}  >
       <option value ="">  ปี พ.ศ  </option>
       {
         this.state.year.map(
           data =>
           <option value={data}  selected={this.state.varvalue15year == data ? 'selected' : ''}>{data}</option>
         )
         }
       </select></th>
     </tr>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins15}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.defaultvarvalue15}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins15}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins12(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins12',{
      id:this.props.id,
      fixins12:this.state.varvalue12day+'/'+this.state.varvalue12month+'/'+this.state.varvalue12year,
    }).then(res=>{

      //console.log(res.data);
      this.setState({
        defaultvarvalue12:this.state.varvalue12day+'/'+this.state.varvalue12month+'/'+this.state.varvalue12year,
        flagfixins12:0,
      })
    });
  }
  handleChangefixins12(e){
    //console.log(e.target.value);
    this.setState({
      fixins12:e.target.value,
    })
  }
  openfixins12()
  {
    this.setState({
      flagfixins12:1
    })
  }
  closefixins12()
  {
    this.setState({
      flagfixins12:0
    })
  }
  fixins12()
  {
    if(this.state.flagfixins12 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins12}><tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
       <th style={{backgroundColor:'white'}}>
       <select onChange={(e) => this.setState({ varvalue12day: e.target.value })} name="dayex">
       <option value ="">  วัน  </option>
       <option value ="01" selected={this.state.varvalue12day == '01' ? 'selected' : ''}>  01  </option>
       <option value ="02" selected={this.state.varvalue12day == '02' ? 'selected' : ''}>  02  </option>
       <option value ="03" selected={this.state.varvalue12day == '03' ? 'selected' : ''}>  03  </option>
       <option value ="04" selected={this.state.varvalue12day == '04' ? 'selected' : ''}>  04  </option>
       <option value ="05" selected={this.state.varvalue12day == '05' ? 'selected' : ''}>  05  </option>
       <option value ="06" selected={this.state.varvalue12day == '06' ? 'selected' : ''}>  06  </option>
       <option value ="07" selected={this.state.varvalue12day == '07' ? 'selected' : ''}>  07  </option>
       <option value ="08" selected={this.state.varvalue12day == '08' ? 'selected' : ''}>  08  </option>
       <option value ="09" selected={this.state.varvalue12day == '09' ? 'selected' : ''}>  09  </option>          {
         this.state.day.map(
           data =>
           <option value={data} selected={this.state.varvalue12day == data ? 'selected' : ''}>{data}</option>
         )
         }
         </select>

         <select  onChange={(e) => this.setState({ varvalue12month: e.target.value })}>
         <option value ="">  เดือน  </option>
         <option value ="01"  selected={this.state.varvalue12month == '01' ? 'selected' : ''}>  01  </option>
         <option value ="02"  selected={this.state.varvalue12month == '02' ? 'selected' : ''}>  02  </option>
         <option value ="03"  selected={this.state.varvalue12month == '03' ? 'selected' : ''}>  03  </option>
         <option value ="04"  selected={this.state.varvalue12month == '04' ? 'selected' : ''}>  04  </option>
         <option value ="05"  selected={this.state.varvalue12month == '05' ? 'selected' : ''}>  05  </option>
         <option value ="06"  selected={this.state.varvalue12month == '06' ? 'selected' : ''}>  06  </option>
         <option value ="07"  selected={this.state.varvalue12month == '07' ? 'selected' : ''}>  07  </option>
         <option value ="08"  selected={this.state.varvalue12month == '08' ? 'selected' : ''}>  08  </option>
         <option value ="09"  selected={this.state.varvalue12month == '09' ? 'selected' : ''}>  09  </option>
         {
           this.state.month.map(
             data =>
             <option value={data}  selected={this.state.varvalue12month == data ? 'selected' : ''}>{data}</option>
           )
           }
         </select>
       <select onChange={(e) => this.setState({ varvalue12year: e.target.value })}  >
       <option value ="">  ปี พ.ศ  </option>
       {
         this.state.year.map(
           data =>
           <option value={data}  selected={this.state.varvalue12year == data ? 'selected' : ''}>{data}</option>
         )
         }
       </select></th>
     </tr>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins12}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.defaultvarvalue12}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins12}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins51(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins51',{
      id:this.props.id,
      fixins51:this.state.varvalue51day+'/'+this.state.varvalue51month+'/'+this.state.varvalue51year,
    }).then(res=>{

      //console.log(res.data);
      this.setState({
        defaultvarvalue51:this.state.varvalue51day+'/'+this.state.varvalue51month+'/'+this.state.varvalue51year,
        flagfixins51:0,
      })
    });
  }
  handleChangefixins51(e){
    //console.log(e.target.value);
    this.setState({
      fixins51:e.target.value,
    })
  }
  openfixins51()
  {
    this.setState({
      flagfixins51:1
    })
  }
  closefixins51()
  {
    this.setState({
      flagfixins51:0
    })
  }
  fixins51()
  {
    if(this.state.flagfixins51 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins51}><tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
       <th style={{backgroundColor:'white'}}>
       <select onChange={(e) => this.setState({ varvalue51day: e.target.value })} name="dayex">
       <option value ="">  วัน  </option>
       <option value ="01" selected={this.state.varvalue51day == '01' ? 'selected' : ''}>  01  </option>
       <option value ="02" selected={this.state.varvalue51day == '02' ? 'selected' : ''}>  02  </option>
       <option value ="03" selected={this.state.varvalue51day == '03' ? 'selected' : ''}>  03  </option>
       <option value ="04" selected={this.state.varvalue51day == '04' ? 'selected' : ''}>  04  </option>
       <option value ="05" selected={this.state.varvalue51day == '05' ? 'selected' : ''}>  05  </option>
       <option value ="06" selected={this.state.varvalue51day == '06' ? 'selected' : ''}>  06  </option>
       <option value ="07" selected={this.state.varvalue51day == '07' ? 'selected' : ''}>  07  </option>
       <option value ="08" selected={this.state.varvalue51day == '08' ? 'selected' : ''}>  08  </option>
       <option value ="09" selected={this.state.varvalue51day == '09' ? 'selected' : ''}>  09  </option>          {
         this.state.day.map(
           data =>
           <option value={data} selected={this.state.varvalue51day == data ? 'selected' : ''}>{data}</option>
         )
         }
         </select>

         <select  onChange={(e) => this.setState({ varvalue51month: e.target.value })}>
         <option value ="">  เดือน  </option>
         <option value ="01"  selected={this.state.varvalue51month == '01' ? 'selected' : ''}>  01  </option>
         <option value ="02"  selected={this.state.varvalue51month == '02' ? 'selected' : ''}>  02  </option>
         <option value ="03"  selected={this.state.varvalue51month == '03' ? 'selected' : ''}>  03  </option>
         <option value ="04"  selected={this.state.varvalue51month == '04' ? 'selected' : ''}>  04  </option>
         <option value ="05"  selected={this.state.varvalue51month == '05' ? 'selected' : ''}>  05  </option>
         <option value ="06"  selected={this.state.varvalue51month == '06' ? 'selected' : ''}>  06  </option>
         <option value ="07"  selected={this.state.varvalue51month == '07' ? 'selected' : ''}>  07  </option>
         <option value ="08"  selected={this.state.varvalue51month == '08' ? 'selected' : ''}>  08  </option>
         <option value ="09"  selected={this.state.varvalue51month == '09' ? 'selected' : ''}>  09  </option>
         {
           this.state.month.map(
             data =>
             <option value={data}  selected={this.state.varvalue51month == data ? 'selected' : ''}>{data}</option>
           )
           }
         </select>
       <select onChange={(e) => this.setState({ varvalue51year: e.target.value })}  >
       <option value ="">  ปี พ.ศ  </option>
       {
         this.state.year.map(
           data =>
           <option value={data}  selected={this.state.varvalue51year == data ? 'selected' : ''}>{data}</option>
         )
         }
       </select></th>
     </tr>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins51}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.defaultvarvalue51}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins51}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins38(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins38',{
      id:this.props.id,
      fixins38:this.state.fixins38,
    }).then(res=>{

      //console.log(res.data);
      this.setState({
        defaultvarvalue38:this.state.fixins38,
        flagfixins38:0,
      })
    });
  }
  handleChangefixins38(e){
    //console.log(e.target.value);
    this.setState({
      fixins38:e.target.value,
    })
  }
  openfixins38()
  {
    this.setState({
      flagfixins38:1
    })
  }
  closefixins38()
  {
    this.setState({
      flagfixins38:0
    })
  }
  fixins38()
  {
    if(this.state.flagfixins38 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins38}><input onChange={this.handleChangefixins38} value={this.state.fixins38} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins38}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.defaultvarvalue38}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins38}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins39(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins39',{
      id:this.props.id,
      fixins39:this.state.fixins39,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        defaultvarvalue39:this.state.fixins39,
        flagfixins39:0,
      })
    });
  }
  handleChangefixins39(e){
    //console.log(e.target.value);
    this.setState({
      fixins39:e.target.value,
    })
  }
  openfixins39()
  {
    this.setState({
      flagfixins39:1
    })
  }
  closefixins39()
  {
    this.setState({
      flagfixins39:0
    })
  }
  fixins39()
  {
    if(this.state.flagfixins39 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins39}><input onChange={this.handleChangefixins39} value={this.state.fixins42} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins39}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.defaultvarvalue39}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins39}>แก้ไข</span></div>
    }
  }

  handleSubmitfixins40(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins40',{
      id:this.props.id,
      fixins40:this.state.day40+'/'+this.state.month40+'/'+this.state.year40,
    }).then(res=>{

      //console.log(res.data);
      this.setState({
        defaultvarvalue40:this.state.day40+'/'+this.state.month40+'/'+this.state.year40,
        flagfixins40:0,
      })
    });
  }
  handleChangefixins40(e){
    //console.log(e.target.value);
    this.setState({
      fixins40:e.target.value,
    })
  }
  openfixins40()
  {
    this.setState({
      flagfixins40:1
    })
  }
  closefixins40()
  {
    this.setState({
      flagfixins40:0
    })
  }
  fixins40()
  {
    if(this.state.flagfixins40 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins40}>
      <select onChange={(e) => this.setState({ day40: e.target.value })} name="dayex">
      <option value ="">  วัน  </option>
      <option value ="01">  01  </option>
      <option value ="02">  02  </option>
      <option value ="03">  03  </option>
      <option value ="04">  04  </option>
      <option value ="05">  05  </option>
      <option value ="06">  06  </option>
      <option value ="07">  07  </option>
      <option value ="08">  08  </option>
      <option value ="09">  09  </option>          {
        this.state.day.map(
          data =>
          <option value={data}>{data}</option>
        )
        }
        </select>

        <select  onChange={(e) => this.setState({ month40: e.target.value })}>
        <option value ="">  เดือน  </option>
        <option value ="01">  01  </option>
        <option value ="02">  02  </option>
        <option value ="03">  03  </option>
        <option value ="04">  04  </option>
        <option value ="05">  05  </option>
        <option value ="06">  06  </option>
        <option value ="07">  07  </option>
        <option value ="08">  08  </option>
        <option value ="09">  09  </option>
        {
          this.state.month.map(
            data =>
            <option value={data}>{data}</option>
          )
          }
        </select>
      <select onChange={(e) => this.setState({ year40: e.target.value })}  >
      <option value ="">  ปี พ.ศ  </option>
      {
        this.state.year.map(
          data =>
          <option value={data}>{data}</option>
        )
        }
      </select>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins40}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.defaultvarvalue40}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins40}>แก้ไข</span></div>
    }
  }
  copyact()
  {
    if(this.props.filepublicname == null || this.props.filepublicname == '' ||this.props.filepublicname == 'undefined')
    {
      if(this.state.defaultvarvalue12 == null || this.state.defaultvarvalue12 == '' ||this.state.defaultvarvalue12 == 'undefined')
      {
        return  <th style={{backgroundColor:'white'}}><span style={{fontSize:'12px',color:'red'}}>ระบุวันที่{this.props.varname12}</span><br/><a disabled className="btn btn-default">อัพโหลด</a></th>

      }
      else
      {
        return  <th style={{backgroundColor:'white'}}><a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+this.props.id+"/xxx/CG4CG/Case_Attachment?cat?CA45CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" className="btn btn-default">อัพโหลด</a></th>

      }
    }
    else
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp; <a href={'/SecurityBroke/showfile/' + this.props.fileid} target="_blank">{this.props.filepublicname}</a></th>
    }
  }
    render() {
      return (
        <div className="column22" id="act">
        <div className={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
        <div className="box-header  ">
          <b className="box-title" data-widget="collapse">พรบ.</b>
          <br/>
          <br/>
           <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
           <thead>
           <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
          <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >บริษัทประกันที่เลิอก</th>
            <th style={{backgroundColor:'white'}}>{this.props.companyname}</th>
          </tr>
           <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
          <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>Partner (Channel เดิม)</th>
            <th style={{backgroundColor:'white'}}>{this.props.partnername}</th>
          </tr>
          </thead>
           </table>
          <div className="box-tools pull-right">

            <button type="button" className="btn btn-box-tool" data-widget="collapse"><i className="fa fa-plus"></i></button>
          </div>
        </div>
        <div className="box-body" style={{}}>
        <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
        <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
       <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>ไฟล์สำเนา พรบ.</th>
       {this.copyact()}
       </tr>
         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
        <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname12}</th>
          <th style={{backgroundColor:'white'}}>{this.fixins12()}</th>
        </tr>
         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
        <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname51}</th>
          <th style={{backgroundColor:'white'}}>{this.fixins51()}</th>
        </tr>
         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
        <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname51}</th>
          <th style={{backgroundColor:'white'}}>{this.fixins15()}</th>
        </tr>
         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
        <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname38}</th>
          <th style={{backgroundColor:'white'}}>{this.fixins38()}</th>
        </tr>
         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
        <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname39}</th>
          <th style={{backgroundColor:'white'}}>{this.fixins39()}</th>
        </tr>
         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
        <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname40}</th>
          <th style={{backgroundColor:'white'}}>{this.fixins40()}</th>
        </tr>
        </thead>
        </table>
        </div>
        </div>
        <br/>
        <br/>
        </div>
        );
    }
}

if (document.getElementById('offeract')) {
  const component = document.getElementById('offeract');
  const props = Object.assign({}, component.dataset);
    ReactDOM.render(<OfferAct {...props}/>, component);
}
