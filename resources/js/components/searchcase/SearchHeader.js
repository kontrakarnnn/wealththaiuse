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

export default class SearchHeader extends Component {

  constructor(){
    super();
    ////console.log(super());
    this.state = {
      casefilter:[],
      casename:'',
      casecode:'',
      casetype:'',
      casestatus:'',
      casechannel:'',
      caseacceptdate:'',
      casetypelist:[],
      hide:0,
      minusorplus:'fa fa-minus',
      casestatuslist:[],
      casechannellist:[],
      createdday:'',
      createdmonth:'',
      createdyear:'',
      finishedday:'',
      finishedmonth:'',
      finishedyear:'',
      day:[],
      month:[],
      year:[],
      structurelist:[],
      structure:'',
      blockarray:[],
      blocklist:[],
      block:'',
      userlist:[],
      user:'',
      partnerblocklist:[],
      partnerblock:'',
      membername:'',
      memberlname:'',
      assetname:'',
      assetrefname:'',
      advisorname:'',
    };

    this.handleSubmit = this.handleSubmit.bind(this);
    this.clickhideorshow = this.clickhideorshow.bind(this);
    this.filterblockbystructure = this.filterblockbystructure.bind(this);
    this.submitallcase = this.submitallcase.bind(this);


  }
  componentDidMount() {
    axios.get('/wealththaiinsurance/load/casetype').then(response=>{
      console.log(response.data)
      this.setState({casetypelist:response.data});

    })
    axios.get('/wealththaiinsurance/all/casestatus').then(response=>{
      console.log(response.data)
      this.setState({casestatuslist:response.data});

    })
    axios.get('/wealththaiinsurance/load/casechannel').then(response=>{
      this.setState({casechannellist:response.data});
    })
    axios.get('/wealththaiinsurance/load/month').then(response=>{
      this.setState({month:response.data});
    })
    axios.get('/wealththaiinsurance/load/day').then(response=>{
      this.setState({day:response.data});
    })
    axios.get('/wealththaiinsurance/load/year').then(response=>{
      this.setState({year:response.data});
    })
    axios.get('/wealththaiinsurance/get/structure').then(response=>{
      this.setState({structurelist:response.data});
    })
    axios.get('/wealththaiinsurance/report/getblock').then(response=>{
      this.setState({blockarray:response.data});
    })
    axios.get('/wealththaiinsurance/load/alluser').then(response=>{
      this.setState({userlist:response.data});
    })
    axios.get('/wealththaiinsurance/load/partner').then(response=>{
      this.setState({partnerblocklist:response.data});
    })
  }
  handleSubmit(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/all/searchcasepost',{
      casecode:this.state.casecode,
      casetype:this.state.casetype,
      casename:this.state.casename,
      casestatus:this.state.casestatus,
      casechannel:this.state.casechannel,
      caseacceptdate:this.state.createdday+"/"+this.state.createdmonth+"/"+this.state.createdyear,
      finisheddate:this.state.finishedday+"/"+this.state.finishedmonth+"/"+this.state.finishedyear,
      coordinate:this.state.user,
      userblock:this.state.block,
      partnerblock:this.state.partnerblock,
      membername:this.state.membername,
      memberlname:this.state.memberlname,
      assetname:this.state.assetname,
      assetrefname:this.state.assetrefname,
      advisorname:this.state.advisorname,

    }).then(res=>{

      console.log(res.data);
      this.setState({
        casefilter:res.data,
      })
    });

  }
  submitallcase(e)
  {
    e.preventDefault();
    axios.post('/wealththaiinsurance/all/searchcasepost',{
      casecode:'',
      casetype:'',
      casename:'',
      casestatus:'',
      casechannel:'',
      caseacceptdate:'',
      coordinate:'',
      userblock:'',
      partnerblock:'',
      membername:'',
      memberlname:'',
      assetname:'',
      assetrefname:'',
      advisorname:'',

    }).then(res=>{

      console.log(res.data);
      this.setState({
        casefilter:res.data,
      })
    });

  }

  filterblockbystructure(e)
  {
    console.log(e.target.value);

    let blockarr= this.state.blockarray.filter((block) => {
     return block.structure_id == e.target.value
   })
   this.setState({
     blocklist :blockarr
   })
   console.log(this.state.blocklist);

 }
clickhideorshow()
{
  if(this.state.hide == 1)
  {
    this.setState({
      hide:0,
      minusorplus:'fa fa-minus'
    })
  }
  else
  {
    this.setState({
      hide:1,
      minusorplus:'fa fa-plus'
    })
  }

}
hideorshow()
{
  if(this.state.hide == 1)
  {
    return
  }
  else
  {
    return <form onSubmit={this.handleSubmit}>
    <div className="column3">
    <table >
    <tr role="row" >
      <th >รหัสงาน &nbsp;</th>
      <td ><input  type="text" className="form-control" onChange={(e) => this.setState({ casecode: e.target.value })} value={this.state.casecode}/></td>
   </tr>
   <tr role="row" >&nbsp;</tr>
   <tr role="row" >
    <th >ประเภทงาน &nbsp;</th>
    <td ><select className="form-control" style={{width:'195px'}} onChange={(e) => this.setState({ casetype: e.target.value })}><option value="">ไม่เลือก</option>{this.state.casetypelist.map(data => <option value={data.id}>{data.name}</option>)}</select></td>
  </tr>
   <tr role="row" >&nbsp;</tr>
   <tr role="row" >
    <th >ชื่องาน &nbsp;</th>
    <td ><input id="name" type="text" className="form-control" onChange={(e) => this.setState({ casename: e.target.value })} value={this.state.casename}  /></td>
  </tr>
  <tr role="row" >&nbsp;</tr>
  <tr role="row" >
   <th >สถานะงาน &nbsp;</th>
   <td ><select className="form-control" style={{width:'195px'}} onChange={(e) => this.setState({ casestatus: e.target.value })}><option value="">ไม่เลือก</option>{this.state.casestatuslist.map(data => <option value={data.id}>{data.name}</option>)}</select></td>
 </tr>
 <tr role="row" >&nbsp;</tr>
 <tr role="row" >
  <th >วันที่รับงาน &nbsp;</th>
  <td >
<select onChange={(e) => this.setState({ createdday: e.target.value })} name="dayex">
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

  &nbsp;

  <select  onChange={(e) => this.setState({ createdmonth: e.target.value })}>
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
  &nbsp;

  <select onChange={(e) => this.setState({ createdyear: e.target.value })}  >
  <option value ="">  ปี พ.ศ  </option>
  {
    this.state.year.map(
      data =>
      <option value={data}>{data}</option>
    )
    }
  </select></td>
</tr>
<tr role="row" >&nbsp;</tr>
<tr role="row" >
 <th >วันทีงานเสร็จสิ้น &nbsp;</th>
 <td >
<select onChange={(e) => this.setState({ finishedday: e.target.value })} name="dayex">
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

 &nbsp;

 <select  onChange={(e) => this.setState({ finishedmonth: e.target.value })}>
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
 &nbsp;

 <select onChange={(e) => this.setState({finishedyear: e.target.value })}  >
 <option value ="">  ปี พ.ศ  </option>
 {
   this.state.year.map(
     data =>
     <option value={data}>{data}</option>
   )
   }
 </select></td>
</tr>
    </table>
    </div>
    <div className="column3">
    <table >
    <tr role="row" >
     <th >เส้นทางรับงาน &nbsp;</th>
     <td ><select className="form-control" style={{width:'195px'}} onChange={(e) => this.setState({ casechannel: e.target.value })}><option value="">ไม่เลือก</option>{this.state.casechannellist.map(data => <option value={data.id}>{data.name}</option>)}</select></td>
    </tr>
    <tr role="row" >&nbsp;</tr>
    <tr role="row" >
     <th >Structure</th>
     <td ><select className="form-control" style={{width:'195px'}} onChange={this.filterblockbystructure}><option value="">ไม่เลือก</option>{this.state.structurelist.map(data => <option value={data.id}>{data.name}</option>)}</select></td>
   </tr>
   <tr role="row" >&nbsp;</tr>
    <tr role="row" >
     <th >ผู้แจ้งงาน &nbsp;</th>
     <td ><select className="form-control" style={{width:'195px'}} onChange={(e) => this.setState({ block: e.target.value })}><option value="">ไม่เลือก</option>{this.state.blocklist.map(data => <option value={data.id}>{data.name}</option>)}</select></td>
   </tr>
   <tr role="row" >&nbsp;</tr>
   <tr role="row" >
    <th >ผู้ประสานงาน &nbsp;</th>
    <td ><select className="form-control" style={{width:'195px'}} onChange={(e) => this.setState({ user: e.target.value })}><option value="">ไม่เลือก</option>{this.state.userlist.map(data => <option value={data.id}>{data.firstname}</option>)}</select></td>
  </tr>
  <tr role="row" >&nbsp;</tr>
  <tr role="row" >
   <th >ผู้ให้คำปรึกษา &nbsp;</th>
   <td ><select className="form-control" style={{width:'195px'}} onChange={(e) => this.setState({ partnerblock: e.target.value })}><option value="">ไม่เลือก</option>{this.state.partnerblocklist.map(data => <option value={data.id}>{data.name}</option>)}</select></td>
 </tr>

    </table>
    </div>
    <div className="column3">
    <table >
 <tr role="row" >
  <th >ชื่อลูกค้า &nbsp;</th>
  <td ><input id="name" type="text" className="form-control" onChange={(e) => this.setState({ membername: e.target.value })}  /></td>
</tr>
<tr role="row" >&nbsp;</tr>
<tr role="row" >
 <th >นามสกุลลูกค้า &nbsp;</th>
 <td ><input id="name" type="text" className="form-control" onChange={(e) => this.setState({ memberlname: e.target.value })}  /></td>
</tr>
<tr role="row" >&nbsp;</tr>
<tr role="row" >
  <th >ชื่อรถลูกค้า &nbsp;</th>
  <td ><input id="name" type="text" className="form-control" onChange={(e) => this.setState({ assetname: e.target.value })}  /></td>
</tr>
<tr role="row" >&nbsp;</tr>
<tr role="row" >
<th >ทะเบียนรถลูกค้า &nbsp;</th>
<td ><input id="name" type="text" className="form-control" onChange={(e) => this.setState({ assetrefname: e.target.value })} /></td>
</tr>
<tr role="row" >&nbsp;</tr>
<tr role="row" >
<th >ชื่อผู้แนะนำ</th>
<td ><input id="name" type="text" className="form-control" onChange={(e) => this.setState({ advisorname: e.target.value })} /></td>
</tr>
    </table>
    </div>

    <div className="column">
    <button type="button" onClick={this.submitallcase} class="btn btn-default" style={{folat:'right'}}>
      All Cases
    </button>&nbsp;
    <a href="/wealththaiinsurance/all/searchcase"><button type="button"  class="btn btn-warning" style={{folat:'right'}}>
    Clear Search
    </button></a>&nbsp;
      <button type="submit" class="btn btn-primary" style={{folat:'right'}}>
        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
        Search
      </button>

      </div>
   </form>
  }
}

  showfilterdata()
  {
    if(this.state.casefilter.length > 0)
    {
      return <div className="card-body" style={{overflowX:'auto'}}>
        <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
          <tr role="row" style={{backgroundColor:'#E3E3E3'}}>
          <th colSpan="5" style={{textAlign:'center'}}>ข้อมูลงาน</th>
          <th colSpan="3" style={{textAlign:'center'}}>บุคคลที่เกี่ยวข้องกับงาน</th>
          <th colSpan="2" style={{textAlign:'center'}}>ข้อมูลลูกค้า</th>
          <th colSpan="2" style={{textAlign:'center'}}>ข้อมูลสินทรัพย์ลูกค้า</th>
          <th colSpan="1" style={{textAlign:'center'}}>ผู้แนะนำ</th>

          </tr>
          <tr role="row" style={{backgroundColor:'#E3E3E3'}}>
          <th>รหัสงาน</th>
          <th>ประเภทงาน</th>
          <th>ชื่องาน</th>
          <th>สถานะงาน</th>
          <th>วันที่รับงาน</th>
          <th>ผู้แจ้งงาน</th>
          <th>ผู้ประสานงาน</th>
          <th>ผู้ให้คำปรึกษา</th>
          <th>ชื่อ</th>
          <th>นามสกุล</th>
          <th>ชื่อ</th>
          <th>ทะเบียนรถ</th>
          <th>ชื่อ</th>

          </tr>
          </thead>
          <tbody>
          {this.state.casefilter.map(data =>
            <tr role="row" className="table-tr" data-url={'/wealththaiinsurance/cases/'+data.id+'/detail/show'}>
            <td>{data.id}</td>
            <td>{data.type_name}</td>
            <td>{data.name}</td>
            <td>{data.status_name}</td>
            <td>{data.case_created_date}</td>
            <td>{data.block_name}</td>
            <td>{data.coordinator_name}</td>
            <td>{data.partner_block_name}</td>
            <td>{data.member_name}</td>
            <td>{data.member_lname}</td>
            <td>{data.asset_name}</td>
            <td>{data.asset_refname}</td>
            <td>{data.advisor_name}</td>

            </tr>
          )}
          </tbody>
          <tfoot>
          <tr role="row" >
          <th>รหัสงาน</th>
          <th>ประเภทงาน</th>
          <th>ชื่องาน</th>
          <th>สถานะงาน</th>
          <th>วันที่รับงาน</th>
          <th>ผู้แจ้งงาน</th>
          <th>ผู้ประสานงาน</th>
          <th>ผู้ให้คำปรึกษา</th>
          <th>ชื่อ</th>
          <th>นามสกุล</th>
          <th>ชื่อ</th>
          <th>ทะเบียนรถ</th>
          <th>ชื่อ</th>
          </tr>
          </tfoot>
          </table>
            </div>
    }
    else
    {
      return <div className="card-body" style={{overflowX:'auto'}}>
        <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
          </thead>
          <tbody>
                        <tr role="row">
                        <td style={{textAlign:'center'}}>No Data Found</td>
                        </tr>
          </tbody>
          </table>
            </div>
    }

  }
    render() {
      return (
        <div>
        <div class="card">
        <div class="card-header">
        <div className="column"><button style={{float:'right',padding:'10px'}} type="button" onClick={this.clickhideorshow} className="btn btn-box-tool" ><span style={{color:'',fontSize:'16px'}}><i className={this.state.minusorplus}></i></span></button></div>
        {this.hideorshow()}
        </div>
       {this.showfilterdata()}

       </div>
       </div>

        );
    }
}

if (document.getElementById('searchheader')) {
  const component = document.getElementById('searchheader');
  const props = Object.assign({}, component.dataset);
    ReactDOM.render(<SearchHeader {...props}/>, component);
}
