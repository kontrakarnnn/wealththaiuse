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

export default class CustomerRanking extends Component {

  constructor(){
    super();
    ////console.log(super());
    this.state = {
      day:[],
      month:[],
      year:[],
      fromdateday:'',
      fromdatemonth:'',
      fromdateyear:'',
      todateday:'',
      todatemonth:'',
      todateyear:'',
      tableflag:0,
      cases:[],
      block:[],
      blockid:'',
      underblock:0,
      blockfilter:[],
      userauth:[],
      userinblock:[],
      blockcommission:[],
      structure:[],
      structureid:'',
      allblockcommission:'',
      blockarray:[],
      customer:[],

    };

    this.Searchclick = this.Searchclick.bind(this);
    this.tableshow = this.tableshow.bind(this);
    this.Exportpdf = this.Exportpdf.bind(this);
    this.filterblockbystructure = this.filterblockbystructure.bind(this);

  }
  componentDidMount() {
      setInterval(() => this.forceUpdate(), 1000);
      axios.get('/wealththaiinsurance/report/getblock').then(response=>{
        this.setState({blockarray:response.data});
      })
      axios.get('/wealththaiinsurance/load/day').then(response=>{
        this.setState({day:response.data});
      })
      axios.get('/wealththaiinsurance/load/month').then(response=>{
        this.setState({month:response.data});
      })
      axios.get('/wealththaiinsurance/load/year?fromreport').then(response=>{
        this.setState({year:response.data});
      })
      axios.get('/wealththaiinsurance/get/structure').then(response=>{
        this.setState({structure:response.data});
      })
  }
  tablerow()
  {
    return [ 'First', 'Second', 'Third', 'The last one' ],
    [ 'Value 1', 'Value 2', 'Value 3', 'Value 4' ],
    [ { text: 'Bold value', bold: true }, 'Val 2', 'Val 3', 'Val 4' ]
  }
  filterblockbystructure(e)
  {
    //console.log(e.target.value);
    this.state.block = this.state.blockarray.filter((block) => {
     return block.structure_id == e.target.value
   })
 }
  Exportpdf()
  {
    var bodyData = [];
    bodyData.push([ {text:'No.',fillColor:'silver'}, {text:'Customer Name',fillColor:'silver'}, {text:'Premium',fillColor:'silver'}, {text:'% Income',fillColor:'silver'}]);
    let arr = [this.state.blockfilter.map(item=>[{text:item.id,}]),this.state.blockfilter.map(item=>[item.structure.name]),this.state.blockfilter.map(item=>[item.name]),this.state.blockfilter.map(item=>this.showunderblockpdf(item)),this.state.blockfilter.map(data=>this.showuserinblockpdf(data)),this.state.blockfilter.map(item=>[item.name]),this.state.blockfilter.map(item=>[item.name])];
    this.state.customer.forEach((sourceRow,index) => {
      var dataRow = [];
    //  dataRow.push([ 'No.', 'Structure Name', 'Block Name', 'Belong To', 'User Name', 'Block Commission', '% Income'] )
      dataRow.push(++index);
      dataRow.push(sourceRow.name);
      dataRow.push(sourceRow.total_premium);
      dataRow.push(this.showcasecominblockpdf(sourceRow));
      bodyData.push(dataRow)
    });
    bodyData.push([ {text:'Total Number of Block',fillColor:'green'}, this.state.blockfilter.length ,this.state.allblockcommission, '100%']);
    let header = "Customer Ranking Report"
    let fromdatetodate = "ตั้งแต่วันที่ "+this.state.fromdateday+'/'+this.state.fromdatemonth+'/'+this.state.fromdateyear+' ถึงวันที่ '+this.state.todateday+'/'+this.state.todatemonth+'/'+this.state.todateyear
    var docDefinition = {
      pageSize: 'A4',
      pageOrientation: 'protait',
      content: [

    {text: header, fontSize: 15 ,alignment:'center'},
    {text: fromdatetodate, fontSize: 15 ,alignment:'center'},
    {

       table:{
                     headerRows: 1,
                     body:bodyData

                      }
          },
  ],

  defaultStyle:{font: 'THSarabunNew',
                fontSize: 15}
};
pdfMake.createPdf(docDefinition).open()
  }
  Searchclick()
  {
    axios.post('/wealththaiinsurance/report/filterblock',{
      fromdate:this.state.fromdateday+'/'+this.state.fromdatemonth+'/'+this.state.fromdateyear,
      todate:this.state.todateday+'/'+this.state.todatemonth+'/'+this.state.todateyear,
      blockid:this.state.blockid,
      underblock:this.state.underblock,
    }).then(res=>{
      //console.log(res.data);

      if(res.data <= 0)
      {
        this.setState({
          tableflag:2
        })
      }
      else
      {
        this.setState({
          blockfilter:res.data,
          tableflag:1
        })
      }
      //console.log('Block',this.state.blockfilter);
    });
    axios.post('/wealththaiinsurance/report/filtercase',{
      fromdate:this.state.fromdateday+'/'+this.state.fromdatemonth+'/'+this.state.fromdateyear,
      todate:this.state.todateday+'/'+this.state.todatemonth+'/'+this.state.todateyear,
      blockid:this.state.blockid,
      underblock:this.state.underblock,
    }).then(response=>{
      this.setState({
        cases:response.data,
      })
      //console.log(response.data);
      //console.log('Cases',this.state.cases);
    });
    axios.post('/wealththaiinsurance/report/filtercustomer',{
      fromdate:this.state.fromdateday+'/'+this.state.fromdatemonth+'/'+this.state.fromdateyear,
      todate:this.state.todateday+'/'+this.state.todatemonth+'/'+this.state.todateyear,
      blockid:this.state.blockid,
      underblock:this.state.underblock,
    }).then(response=>{
      this.setState({
        customer:response.data,
      })
      let sumall;
      let result = [];
      let allblock;
      let sum = this.state.customer.map(data =>result.push(data.total_premium));
      //console.log("Result"+result.length);
      if(result.length>0)
      {

         allblock =  result.reduce((result2,number)=> Number(result2)+Number(number));
         allblock = allblock.toFixed(2)
      }
      else
      {
         allblock = 0;
      }
      this.setState({
        allblockcommission:allblock,
      })
      //console.log(response.data);
      //console.log('customer',this.state.customer);
    });
    axios.post('/wealththaiinsurance/report/userauth',{
      blockid:this.state.blockid,
      underblock:this.state.underblock,
    }).then(responseuser=>{
      this.setState({
        userauth:responseuser.data,
      })


    });
    }
    showcaseincomeinblock(data)
    {
      let income = this.state.cases.filter((cases) => {
       return cases.cases.member_case_owner == data.id
     })
     let sumall;
     let ans;
      ans = data.total_premium/this.state.allblockcommission*100;
      ans = ans.toFixed(2);
      if(ans == "Infinity")
      {
        return <td>0</td>
      }
      else if(ans == "NaN")
      {
        return <td>0</td>
      }
      else
      {
        return <td>{ans}%</td>;

      }
    }

    showcasecominblockpdf(sourceRow)
    {
      let income = this.state.cases.filter((cases) => {
       return cases.cases.member_case_owner == sourceRow.id
     })
     let sumall;
     let ans;
      ans = sourceRow.total_premium/this.state.allblockcommission*100;
      ans = ans.toFixed(2);
      if(ans == "Infinity")
      {
        return <td>0</td>
      }
      else if(ans == "NaN")
      {
        return <td>0</td>
      }
      else
      {
        return ans ;

      }
    }
    showcasecominblock(data)
    {
      this.state.blockcommission = this.state.cases.filter((cases) => {
       return cases.cases.member_case_owner == data.id
     })
     let sumall;
     let result = [];
     let sum= this.state.blockcommission.map(data =>result.push(data.offer.offer_payment_value1));
     if(result.length>0)
     {
        sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
     }
     else
     {
        sumall = 0;
     }
     return <td>{sumall}</td>;
    }
    showuserinblock(data)
    {
      this.state.userinblock = this.state.userauth.filter((userauth) => {
       return userauth.block_id == data.id
     })
     return <td>{this.state.userinblock.map(name =><p>{name.user.firstname} </p>)}</td>
    }
    showuserinblockpdf(data)
    {
      this.state.userinblock = this.state.userauth.filter((userauth) => {
       return userauth.block_id == data.id
     })
     if(this.state.userinblock == null ||this.state.userinblock == 0 ||this.state.userinblock == '' )
     {
       return " "
     }
     else
     {
       return this.state.userinblock.map(name =>name.user.firstname )
     }
    }
    showunderblockpdf(sourceRow)
    {
      if(sourceRow.under_block == null ||sourceRow.under_block == 0 ||sourceRow.under_block == '' )
      {
        return ""

      }
      else
      {
        if(sourceRow.belongtoblock.name == sourceRow.name )
        {
          return {text:sourceRow.belongtoblock.name,fillColor:'silver'}

        }
        return {text:sourceRow.belongtoblock.name,fillColor:''}

      }
    }
  showunderblock(data)
  {
    if(data.under_block == null ||data.under_block == 0 ||data.under_block == '' )
    {
      return <td></td>

    }
    else
    {
      return <td>{data.belongtoblock.name}</td>

    }
  }
  tableshow()
  {
    if(this.state.tableflag == 0)
    {
      return <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
          <tr role="row">
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">No. </th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Customer Name </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Premium </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% Income </th>

              </tr>
          </thead>
          </table>
    }
    else if (this.state.tableflag == 1)
    {
      return <div> <ReactHTMLTableToExcel
                    id="test-table-xls-button"
                    className="download-table-xls-button"
                    table="table-to-xls"
                    filename="customer_ranking_report"
                    sheet="tablexls"
                    buttonText="Export as Excel"/>&nbsp;
                    <button onClick={this.Exportpdf}>Export as PDF </button>

                    <table id="table-to-xls" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
          <tr role="row" class="pagebreak">
          <th  style={{width:'10px'}} tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">No. </th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Customer Name </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Premium </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% Income </th>


              </tr>
          </thead>
          <tbody>
          {
          this.state.customer.map(
            (data,index) =>
          <tr>
          <td>{++index}</td>
          <td>{data.name}</td>
          <td>{data.total_premium}</td>
          {this.showcaseincomeinblock(data)}

          </tr>
          )}


          </tbody>
          <tfoot>
          <tr class="pagebreak">
          <th colspan="" style={{backgroundColor:'green'}}> Total Customer	</th>
          <th colspan="" >{this.state.customer.length}</th>
          <th colspan="">{this.state.allblockcommission} </th>
          <th colspan=""> 100% </th>
          </tr>
          </tfoot>
          </table>

          </div>
    }
    else if(this.state.tableflag == 2)
    {
      return <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
          <tr role="row">
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">No. </th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Customer Name </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Premium </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% Income </th>
              </tr>
          </thead>
          <tbody>
          <tr>
          <td colspan="6" style={{textAlign:'center',color:'red',fontSize:'18px'}}><b>ไม่พบข้อมูล</b></td>
          </tr>
          </tbody>
          <tfoot>
          <tr>
          <th colspan=""> </th>
          <th colspan="" style={{backgroundColor:'green'}}> Total Number of Block</th>
          <th colspan="" > </th>
          <th colspan="" style={{backgroundColor:'orange'}}>Total Number Of USER </th>
          <th colspan="" > </th>
          <th colspan=""> </th>
          <th colspan=""> </th>
          </tr>
          </tfoot>
          </table>
    }
  }
    render() {
      return (
            <div>
            <div class="row">
            <div class="column4">
            <div class="card">
            <div class="card-header">
            <b>จากวันที่</b>
            </div>
            <div class="card-body">
            <select class="form-control" onChange={(e) => this.setState({ fromdateday: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" >  01  </option>
        <option value ="02" >  02  </option>
        <option value ="03" >  03  </option>
        <option value ="04" >  04  </option>
        <option value ="05" >  05  </option>
        <option value ="06" >  06  </option>
        <option value ="07" >  07  </option>
        <option value ="08" >  08  </option>
        <option value ="09" >  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} >{data}</option>
          )
          }
          </select>

          <select  class="form-control" onChange={(e) => this.setState({ fromdatemonth: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  >  01  </option>
          <option value ="02"  >  02  </option>
          <option value ="03"  >  03  </option>
          <option value ="04"  >  04  </option>
          <option value ="05"  >  05  </option>
          <option value ="06"  >  06  </option>
          <option value ="07"  >  07  </option>
          <option value ="08"  >  08  </option>
          <option value ="09"  >  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  >{data}</option>
            )
            }
          </select>
        <select class="form-control" onChange={(e) => this.setState({ fromdateyear: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  >{data}</option>
          )
          }
        </select>
        <br/><br/>
        &nbsp;
            </div>
            </div>
            </div>
            <div class="column4">
            <div class="card">
            <div class="card-header">
            <b>ถึงวันที่</b>
            </div>
            <div class="card-body">
            <select class="form-control" onChange={(e) => this.setState({ todateday: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" >  01  </option>
        <option value ="02" >  02  </option>
        <option value ="03" >  03  </option>
        <option value ="04" >  04  </option>
        <option value ="05" >  05  </option>
        <option value ="06" >  06  </option>
        <option value ="07" >  07  </option>
        <option value ="08" >  08  </option>
        <option value ="09" >  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} >{data}</option>
          )
          }
          </select>

          <select  class="form-control" onChange={(e) => this.setState({ todatemonth: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  >  01  </option>
          <option value ="02"  >  02  </option>
          <option value ="03"  >  03  </option>
          <option value ="04"  >  04  </option>
          <option value ="05"  >  05  </option>
          <option value ="06"  >  06  </option>
          <option value ="07"  >  07  </option>
          <option value ="08"  >  08  </option>
          <option value ="09"  >  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  >{data}</option>
            )
            }
          </select>
        <select class="form-control" onChange={(e) => this.setState({ todateyear: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  >{data}</option>
          )
          }
        </select>
        <br/><br/>
        &nbsp;
            </div>
            </div>
            </div>
            <div class="column4">
            <div class="card">
            <div class="card-header">
            <b>เลือกStructure</b>
            </div>
            <div class="card-body">
            <select class="form-control " id="autowidth"  onChange={this.filterblockbystructure}>
            <option>กรุณาเลือก</option>
            {
              this.state.structure.map(
                data =>
                <option value={data.id}  >{data.name}</option>
              )
            }
              </select><br/><br/>        &nbsp;

            </div>
            </div>
            </div>
            <div class="column4">
            <div class="card">
            <div class="card-header">
            <b>เลือกทีม</b>
            </div>
            <div class="card-body">
            <select class="form-control " id="autowidth"  onChange={(e) => this.setState({ blockid: e.target.value })}>
            <option>กรุณาเลือกทีม</option>
            {
              this.state.block.map(
                data =>
                <option value={data.id}  >{data.name}</option>
              )
            }
              </select><br/><br/>
              ดูทุกทีมที่อยู่ภายใต้ทีมนี <select onChange={(e) => this.setState({ underblock: e.target.value })}><option value="0">ไม่</option><option value="1">ใช่</option></select>
            </div>
            </div>
            </div>


            </div>
            <button style={{float:'right'}} type="submit" class="btn btn-primary" onClick={this.Searchclick}>
              <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
              ค้นหา
            </button><br/><br/>
            <div style={{overflowX:'auto'}}>
            {this.tableshow()}
            </div>

            </div>
        );
    }
}

if (document.getElementById('customerranking')) {
    ReactDOM.render(<CustomerRanking />, document.getElementById('customerranking'));
}
