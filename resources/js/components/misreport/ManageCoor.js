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
import pdfMake from "pdfmake/build/pdfmake";
import pdfFonts from "pdfmake/build/vfs_fonts";
pdfMake.vfs = pdfFonts.pdfMake.vfs;
pdfMake.fonts = {
  THSarabunNew: {
    normal: 'THSarabunNew.ttf',
    bold: 'THSarabunNew-Bold.ttf',
    italics: 'THSarabunNew-Italic.ttf',
    bolditalics: 'THSarabunNew-BoldItalic.ttf'
  },
  Roboto: {
    normal: 'Roboto-Regular.ttf',
    bold: 'Roboto-Medium.ttf',
    italics: 'Roboto-Italic.ttf',
    bolditalics: 'Roboto-MediumItalic.ttf'
  }
}
export default class ManageCoor extends Component {

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
   })  }
  Exportpdf()
  {
    var bodyData = [];
    bodyData.push([ {text:'No.',fillColor:'silver'}, {text:'Co-Ordinator Name',fillColor:'silver'}, {text:'Number of Case',fillColor:'silver'}, {text:'% CASE',fillColor:'silver'}, {text:'Co-Ordinator Fee',fillColor:'silver'}, {text:'Tax Fee',fillColor:'silver'}, {text:'Other Fee',fillColor:'silver'}, {text:'Net Fee',fillColor:'silver'}, {text:'% Net Fee',fillColor:'silver'}, {text:'Company Income',fillColor:'silver'}, {text:'% Company Income',fillColor:'silver'}]);
    this.state.cases.forEach((data,index) => {
      var dataRow = [];
    //  dataRow.push([ 'No.', 'Structure Name', 'Block Name', 'Belong To', 'User Name', 'Block Commission', '% Income'] )
      dataRow.push(++index);
      dataRow.push(data.user_name);
      dataRow.push(data.total_case);
      dataRow.push(this.showpercentcase(data));
      dataRow.push(data.total_fee.toFixed(2));
      dataRow.push(data.total_taxfee.toFixed(2));
      dataRow.push(data.total_otherfee.toFixed(2));
      dataRow.push(Number(data.total_fee.toFixed(2))+Number(data.total_taxfee.toFixed(2))+Number(data.total_otherfee.toFixed(2)));
      dataRow.push(this.showpercentnetfee(data));
      dataRow.push(data.company_income.toFixed(2));
      dataRow.push(this.showpercentcompanyincome(data));
      bodyData.push(dataRow)
    });
    bodyData.push([ '', {text:'Total Cases',fillColor:'green'}, this.showallcase(),{text:'100%'} ,this.showallcasefee(), {text:'Total Net Fee',fillColor:'orange'}, {text:'',fillColor:'orange'}, {text:this.showallnetfee(),fillColor:'orange'}, {text:'100%'},this.showallcompanyincome(),{text:'100%'}]);
    let header = "Management_Report(By Coordinator)"
    let fromdatetodate = "ตั้งแต่วันที่ "+this.state.fromdateday+'/'+this.state.fromdatemonth+'/'+this.state.fromdateyear+' ถึงวันที่ '+this.state.todateday+'/'+this.state.todatemonth+'/'+this.state.todateyear
    var docDefinition = {
      pageSize: 'A4',
      pageOrientation: 'portrait',
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

    axios.post('/wealththaiinsurance/report/coordinatorfiltercase',{
      fromdate:this.state.fromdateday+'/'+this.state.fromdatemonth+'/'+this.state.fromdateyear,
      todate:this.state.todateday+'/'+this.state.todatemonth+'/'+this.state.todateyear,
      blockid:this.state.blockid,
      underblock:this.state.underblock,
    }).then(response=>{
      this.setState({
        cases:response.data,
      })


           let sumall;
           let result = [];
           let allblock;
           let sum = this.state.cases.map(data =>result.push(data.offer_payment_value19));
           //console.log("Result"+result.length);
           if(result.length>0)
           {

              allblock =  result.reduce((result2,number)=> Number(result2)+Number(number));
              allblock =  allblock.toFixed(2);

           }
           else
           {
              allblock = 0;
           }
           this.setState({
             allblockcommission:allblock,
           })
      if(response.data <= 0)
      {
        this.setState({
          tableflag:2
        })
      }
      else
      {
        this.setState({
          tableflag:1
        })
      }
      //console.log(response.data);
      //console.log('Cases',this.state.cases);
    });

    }


    showallnetfee()
    {
      let sumall;
      let result = [];
      let sum= this.state.cases.map(data =>result.push(Number(data.total_fee.toFixed(2))+Number(data.total_taxfee.toFixed(2))+Number(data.total_otherfee.toFixed(2))));
      if(result.length>0)
      {

         sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
      }
      else
      {
         sumall = 0;
      }
      return sumall.toFixed(2);
    }
    showallcompanyincome()
    {
      let sumall;
      let result = [];
      let sum= this.state.cases.map(data =>result.push(data.company_income.toFixed(2)));
      if(result.length>0)
      {

         sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
      }
      else
      {
         sumall = 0;
      }
      return sumall;
    }

    showallcase()
    {

     let sumall;
     let result = [];
     let sum= this.state.cases.map(data =>result.push(data.total_case));
     if(result.length>0)
     {

        sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
     }
     else
     {
        sumall = 0;
     }
     return sumall;
    }
    showallcasefee()
    {

     let sumall;
     let result = [];
     let sum= this.state.cases.map(data =>result.push(data.total_fee));
     if(result.length>0)
     {

        sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
     }
     else
     {
        sumall = 0;
     }
     return sumall.toFixed(2);
    }


    showpercentcase(data)
    {
      let sumall;
      let result = [];
      let ans;
      let sum= this.state.cases.map(data =>result.push(data.total_case));
      if(result.length>0)
      {

         sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
      }
      else
      {
         sumall = 0;
      }
      ans = data.total_case/sumall*100;
      ans = ans;

      if(ans == "Infinity")
      {
        return 0;
      }
      else if(ans == "NaN")
      {
        return 0;
      }
      else
      {
        return ans.toFixed(2);
      }
    }
    showpercentnetfee(data)
    {
      let sumall;
      let result = [];
      let ans;
      let sum= this.state.cases.map(data =>result.push(Number(data.total_fee.toFixed(2))+Number(data.total_taxfee.toFixed(2))+Number(data.total_otherfee.toFixed(2))));
      if(result.length>0)
      {

         sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
      }
      else
      {
         sumall = 0;
      }
      ans = (Number(data.total_fee.toFixed(2))+Number(data.total_taxfee.toFixed(2))+Number(data.total_otherfee.toFixed(2)))/sumall*100;
      ans = ans;

      if(ans == "Infinity")
      {
        return 0
      }
      else if(ans == "NaN")
      {
        return 0
      }
      else
      {
        return ans.toFixed(2);

      }
    }
    showpercentcompanyincome(data)
    {
      let sumall;
      let result = [];
      let ans;
      let sum= this.state.cases.map(data =>result.push(data.company_income));
      if(result.length>0)
      {

         sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
      }
      else
      {
         sumall = 0;
      }
      ans = data.company_income/sumall*100;
      ans = ans;

      if(ans == "Infinity")
      {
        return 0
      }
      else if(ans == "NaN")
      {
        return 0
      }
      else
      {
        return ans;

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
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Co-Ordinator USER Name </th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Number of Case  </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% CASE </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Co-Ordinator Fee </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% Co-Ordinator </th>

              </tr>
          </thead>
          <tbody>

          </tbody>
          <tfoot>
          <tr>
          <th colspan="" > </th>
          <th colspan="" > </th>
          <th colspan="" ></th>
          <th colspan="" > </th>
          <th colspan=""> </th>
          <th colspan=""> </th>
          </tr>
          </tfoot>
          </table>
    }
    else if (this.state.tableflag == 1)
    {
      return  <div> <ReactHTMLTableToExcel
                    id="test-table-xls-button"
                    className="download-table-xls-button"
                    table="table-to-xls"
                    filename="Management_Report_By_Coordinator"
                    sheet="tablexls"
                    buttonText="Export as Excel"/>&nbsp;
                    <button onClick={this.Exportpdf}>Export as PDF </button>

                    <table id="table-to-xls" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
          <tr role="row" class="pagebreak">
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">No. </th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Co-Ordinator Name </th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Number of Case  </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% CASE </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Co-Ordinator Fee </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Tax Fee </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Other Fee </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Net Fee </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% Net Fee </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Company Income </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% Company Income </th>
              </tr>
          </thead>
          <tbody>
          {
          this.state.cases.map(
            (data,index) =>
          <tr>
          <td>{++index}</td>
          <td>{data.user_name}</td>
          <td>{data.total_case}</td>
          <td>{this.showpercentcase(data)}</td>
          <td>{data.total_fee.toFixed(2)}</td>
          <td>{data.total_taxfee.toFixed(2)}</td>
          <td>{data.total_otherfee.toFixed(2)}</td>
          <td>{Number(data.total_fee.toFixed(2))+Number(data.total_taxfee.toFixed(2))+Number(data.total_otherfee.toFixed(2))}</td>
          <td>{this.showpercentnetfee(data)}</td>
          <td>{data.company_income.toFixed(2)}</td>
          <td>{this.showpercentcompanyincome(data)}</td>

          </tr>
          )}


          </tbody>
          <tfoot>
          <tr class="pagebreak">
          <th colspan=""> </th>
          <th colspan="" style={{backgroundColor:'green'}}> Total Cases</th>
          <th>{this.showallcase()}</th>
          <th colspan="" >100% </th>
          <th>{this.showallcasefee()}</th>
          <th colspan="" style={{backgroundColor:'orange'}}> Total Net Fee</th>
          <th colspan="" style={{backgroundColor:'orange'}}> </th>
          <th style={{backgroundColor:'orange'}}>{this.showallnetfee()}</th>
          <th colspan="">100%</th>
          <th colspan="">{this.showallcompanyincome()}</th>
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
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Structure Name </th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Block Name </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Belong To </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">User Name </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Block Commission </th>
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
          <th colspan="" style={{backgroundColor:'green'}}> Total Block</th>
          <th colspan="" > </th>
          <th colspan="" style={{backgroundColor:'orange'}}>Total USER	 </th>
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

if (document.getElementById('managecoor')) {
    ReactDOM.render(<ManageCoor />, document.getElementById('managecoor'));
}
