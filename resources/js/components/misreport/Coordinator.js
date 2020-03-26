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
export default class Coordinator extends Component {

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
    bodyData.push([ {text:'No.',fillColor:'silver'}, {text:'Co-Ordinator Name',fillColor:'silver'}, {text:'Number of Case',fillColor:'silver'}, {text:'% CASE',fillColor:'silver'}, {text:'Co-Ordinator Fee',fillColor:'silver'}, {text:'% Co-Ordinator',fillColor:'silver'}]);
    this.state.cases.forEach((sourceRow,index) => {
      var dataRow = [];
    //  dataRow.push([ 'No.', 'Structure Name', 'Block Name', 'Belong To', 'User Name', 'Block Commission', '% Income'] )
      dataRow.push(++index);
      dataRow.push(sourceRow.user_name);
      dataRow.push(sourceRow.total_case);
      dataRow.push(this.showpercentcasepdf(sourceRow));
      dataRow.push(sourceRow.total_fee.toFixed(2));
      dataRow.push(this.showpercentfeepdf(sourceRow));
      bodyData.push(dataRow)
    });
    bodyData.push([ '', {text:'Total Cases',fillColor:'green'}, this.showallcasepdf(),{text:'100%'} ,this.showallcasefeepdf(), {text:'100%'}]);
    let header = "Coordinator Report"
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
     return <th>{sumall}</th>;
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
     return <th>{sumall.toFixed(2)}</th>;
    }
    showallcasepdf()
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
    showallcasefeepdf()
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
    showpercentfee(data)
    {
      let sumall;
      let result = [];
      let ans;
      let sum= this.state.cases.map(data =>result.push(data.total_fee));
      if(result.length>0)
      {

         sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
      }
      else
      {
         sumall = 0;
      }
      ans = data.total_fee/sumall*100;
      ans = ans;

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
    showpercentcasepdf(sourceRow)
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
      ans = sourceRow.total_case/sumall*100;
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
    showpercentfeepdf(sourceRow)
    {
      let sumall;
      let result = [];
      let ans;
      let sum= this.state.cases.map(data =>result.push(data.total_fee));
      if(result.length>0)
      {

         sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
      }
      else
      {
         sumall = 0;
      }
      ans = sourceRow.total_fee/sumall*100;
      ans = ans;

      if(ans == "Infinity")
      {
        return <td>0</td>
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
                    filename="Coordinator_Report"
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
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% Co-Ordinator </th>
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
          {this.showpercentcase(data)}
          <td>{data.total_fee.toFixed(2)}</td>
          {this.showpercentfee(data)}
          </tr>
          )}


          </tbody>
          <tfoot>
          <tr class="pagebreak">
          <th colspan=""> </th>
          <th colspan="" style={{backgroundColor:'green'}}> Total Cases</th>
          {this.showallcase()}
          <th colspan="" >100% </th>
          {this.showallcasefee()}
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

if (document.getElementById('coordinator')) {
    ReactDOM.render(<Coordinator />, document.getElementById('coordinator'));
}
