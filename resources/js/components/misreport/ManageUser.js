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
export default class ManageUser extends Component {

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
    bodyData.push([ {text:'No.',fillColor:'silver'}, {text:'Structure Name',fillColor:'silver'}, {text:'Block Name',fillColor:'silver'}, {text:'Belong To',fillColor:'silver'}, {text:'User Name',fillColor:'silver'}, {text:'Number Cases',fillColor:'silver'}, {text:'% Cases',fillColor:'silver'}, {text:'Co-Ordinator Fee',fillColor:'silver'}, {text:'Tax Fee',fillColor:'silver'}, {text:'Other Fee',fillColor:'silver'}, {text:'Net Fee',fillColor:'silver'}, {text:'% Net Fee',fillColor:'silver'}, {text:'Company Income (CI)',fillColor:'silver'}, {text:'% Company Income',fillColor:'silver'}]);
    this.state.blockfilter.forEach((data,index) => {
      var dataRow = [];
    //  dataRow.push([ 'No.', 'Structure Name', 'Block Name', 'Belong To', 'User Name', 'Block Commission', '% Income'] )
      dataRow.push(++index);
      dataRow.push(data.structure.name);
      dataRow.push(data.name);
      dataRow.push(this.showunderblockpdf(data));
      dataRow.push(this.showuserinblockpdf(data));
      dataRow.push(this.shownumbercase(data));
      dataRow.push(this.showpercentcase(data));
      dataRow.push(this.showcoordinatorfee(data));
      dataRow.push(this.showtaxfee(data));
      dataRow.push(this.showotherfee(data));
      dataRow.push(this.shownetfee(data));
      dataRow.push(this.showpercentnetfee(data));
      dataRow.push(this.showcompanyincome(data));
      dataRow.push(this.showpercentcompanyincome(data));
      bodyData.push(dataRow)
    });
    bodyData.push([ '', {text:'Total Block',fillColor:'green'}, this.state.blockfilter.length,{text:'Total User		',fillColor:'orange'} ,this.state.userauth.length, this.state.cases.length, '100%','','','',this.showallnetfee(),'100%',this.showallcompanyincome(),'100%']);
    let header = "Management Report(By User)"
    let fromdatetodate = "ตั้งแต่วันที่ "+this.state.fromdateday+'/'+this.state.fromdatemonth+'/'+this.state.fromdateyear+' ถึงวันที่ '+this.state.todateday+'/'+this.state.todatemonth+'/'+this.state.todateyear
    var docDefinition = {
      pageSize: 'A4',
      pageOrientation: 'landscape',
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
                fontSize: 12}
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

           let sumall;
           let result = [];
           let allblock;
           let sum = this.state.cases.map(data =>result.push(data.offer.offer_payment_value19));
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
      //console.log(response.data);
      //console.log('Cases',this.state.cases);
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
    showpercentcompanyincome(data)
    {
      let sumallnet;
      let resultnet = [];
      let sumnet= this.state.cases.map(data =>resultnet.push(data.offer.offer_payment_value21));
      if(resultnet.length>0)
      {

         sumallnet =  resultnet.reduce((resultnet2,number2)=> Number(resultnet2)+Number(number2));
         sumallnet =  sumallnet.toFixed(2);
      }
      else
      {
         sumallnet = 0;
      }
      let income = this.state.cases.filter((cases) => {
       return cases.cases.service_user_block_id == data.id
     })
     let sumall;
     let ans;
     let result = [];
     let sum= income.map(data =>result.push(data.offer.offer_payment_value21));
     if(result.length>0)
     {

        sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
        sumall =  sumall.toFixed(2);

     }
     else
     {
        sumall = 0;
     }
        let allans = sumall/sumallnet*100;
        allans = allans.toFixed(2);
        return allans;

     }
    showallcompanyincome()
    {
     let sumall;
     let ans;
     let result = [];
     let sum= this.state.cases.map(data =>result.push(data.offer.offer_payment_value21));
     if(result.length>0)
     {
        sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
        sumall =  sumall.toFixed(2);
     }
     else
     {
        sumall = 0;
     }
        return sumall;
    }
    showcompanyincome(data)
    {
      let income = this.state.cases.filter((cases) => {
       return cases.cases.service_user_block_id == data.id
     })
     let sumall;
     let ans;
     let result = [];
     let sum= income.map(data =>result.push(data.offer.offer_payment_value21));
     if(result.length>0)
     {

        sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
        sumall =  sumall.toFixed(2);

     }
     else
     {
        sumall = 0;
     }
        return sumall;
    }
    showpercentnetfee(data)
    {
      let sumallnet;
      let resultnet = [];
      let sumnet= this.state.cases.map(data =>resultnet.push(Number(data.offer.offer_payment_value11)+Number(data.offer.offer_payment_value9)+Number(data.offer.offer_payment_value10)));
      if(resultnet.length>0)
      {

         sumallnet =  resultnet.reduce((resultnet2,number2)=> Number(resultnet2)+Number(number2));
         sumallnet =  sumallnet.toFixed(2);
      }
      else
      {
         sumallnet = 0;
      }
      let income = this.state.cases.filter((cases) => {
       return cases.cases.service_user_block_id == data.id
     })
     let sumall;
     let ans;
     let result = [];
     let sum= income.map(data =>result.push(Number(data.offer.offer_payment_value11)+Number(data.offer.offer_payment_value9)+Number(data.offer.offer_payment_value10)));
     if(result.length>0)
     {

        sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
        sumall =  sumall.toFixed(2);

     }
     else
     {
        sumall = 0;
     }
        let allans = sumall/sumallnet*100;
        allans = allans.toFixed(2);
        return allans;

     }

    showallnetfee()
    {

     let sumall;
     let ans;
     let result = [];
     let sum= this.state.cases.map(data =>result.push(Number(data.offer.offer_payment_value11)+Number(data.offer.offer_payment_value9)+Number(data.offer.offer_payment_value10)));
     if(result.length>0)
     {

        sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
        sumall =  sumall.toFixed(2);

     }
     else
     {
        sumall = 0;
     }
        return sumall;
    }
    shownetfee(data)
    {
      let income = this.state.cases.filter((cases) => {
       return cases.cases.service_user_block_id == data.id
     })
     let sumall;
     let ans;
     let result = [];
     let sum= income.map(data =>result.push(Number(data.offer.offer_payment_value11)+Number(data.offer.offer_payment_value9)+Number(data.offer.offer_payment_value10)));
     if(result.length>0)
     {

        sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
        sumall =  sumall.toFixed(2);

     }
     else
     {
        sumall = 0;
     }
        return sumall;
    }
    showotherfee(data)
    {
      let income = this.state.cases.filter((cases) => {
       return cases.cases.service_user_block_id == data.id
     })
     let sumall;
     let ans;
     let result = [];
     let sum= income.map(data =>result.push(data.offer.offer_payment_value11));
     if(result.length>0)
     {

        sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
        sumall =  sumall.toFixed(2);

     }
     else
     {
        sumall = 0;
     }
        return sumall;
    }
    showtaxfee(data)
    {
      let income = this.state.cases.filter((cases) => {
       return cases.cases.service_user_block_id == data.id
     })
     let sumall;
     let ans;
     let result = [];
     let sum= income.map(data =>result.push(data.offer.offer_payment_value9));
     if(result.length>0)
     {

        sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
        sumall =  sumall.toFixed(2);

     }
     else
     {
        sumall = 0;
     }
        return sumall;
    }
    showcoordinatorfee(data)
    {
      let income = this.state.cases.filter((cases) => {
       return cases.cases.service_user_block_id == data.id
     })
     let sumall;
     let ans;
     let result = [];
     let sum= income.map(data =>result.push(data.offer.offer_payment_value10));
     if(result.length>0)
     {

        sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
        sumall =  sumall.toFixed(2);

     }
     else
     {
        sumall = 0;
     }
        return sumall;
    }
    shownumbercase(data)
    {
      this.state.blockcommission = this.state.cases.filter((cases) => {
       return cases.cases.service_user_block_id == data.id
     })
     return this.state.blockcommission.length;
    }
    showpercentcase(data)
    {
      let sumall;
      let result = [];
      let ans;
      this.state.blockcommission = this.state.cases.filter((cases) => {
       return cases.cases.service_user_block_id == data.id
     })

      ans = this.state.blockcommission.length/this.state.cases.length*100;
      ans = ans.toFixed(2);

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
        return ans;
      }
    }
    showcaseincomeinblockpdf(sourceRow)
    {
      let income = this.state.cases.filter((cases) => {
       return cases.cases.service_user_block_id == sourceRow.id
     })
     let sumall;
     let ans;
     let result = [];
     let sum= income.map(data =>result.push(data.offer.offer_payment_value19));
     if(result.length>0)
     {

        sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
        sumall =  sumall.toFixed(2);

     }
     else
     {
        sumall = 0;
     }
      ans = sumall/this.state.allblockcommission*100;
      ans = ans.toFixed(2);

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
    showcaseincomeinblock(data)
    {
      let income = this.state.cases.filter((cases) => {
       return cases.cases.service_user_block_id == data.id
     })
     let sumall;
     let ans;
     let result = [];
     let sum= income.map(data =>result.push(data.offer.offer_payment_value19));
     if(result.length>0)
     {

        sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
        sumall =  sumall.toFixed(2);

     }
     else
     {
        sumall = 0;
     }
      ans = sumall/this.state.allblockcommission*100;
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
      this.state.blockcommission = this.state.cases.filter((cases) => {
       return cases.cases.service_user_block_id == sourceRow.id
     })
     let sumall;
     let result = [];
     let sum= this.state.blockcommission.map(data =>result.push(data.offer.offer_payment_value19));
     if(result.length>0)
     {

        sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
        sumall =  sumall.toFixed(2);

     }
     else
     {
        sumall = 0;
     }
     return sumall;
    }
    showcasecominblockpdf(sourceRow)
    {
      this.state.blockcommission = this.state.cases.filter((cases) => {
       return cases.cases.service_user_block_id == sourceRow.id
     })
     let sumall;
     let result = [];
     let sum= this.state.blockcommission.map(data =>result.push(data.offer.offer_payment_value19));
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
    showcasecominblock(data)
    {
      this.state.blockcommission = this.state.cases.filter((cases) => {
       return cases.cases.service_user_block_id == data.id
     })
     let sumall;
     let result = [];
     let sum= this.state.blockcommission.map(data =>result.push(data.offer.offer_payment_value19));
     if(result.length>0)
     {

        sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
        sumall =  sumall.toFixed(2);

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
    showunderblockpdf(data)
    {
      if(data.under_block == null ||data.under_block == 0 ||data.under_block == '' )
      {
        return ""

      }
      else
      {
        if(data.belongtoblock.name == data.name )
        {
          return {text:data.belongtoblock.name,fillColor:'silver'}

        }
        return {text:data.belongtoblock.name,fillColor:''}

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
      return data.belongtoblock.name

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
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Structure Name </th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Block Name </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Belong To </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">User Name </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Number Cases</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% Cases</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Co-Ordinator Fee </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Tax Fee </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Other Fee </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Net Fee </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% Net Fee</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Company Income (CI)</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% Company Income</th>
              </tr>
          </thead>
          <tbody>

          </tbody>
          <tfoot>
          <tr>
          </tr>
          </tfoot>
          </table>
    }
    else if (this.state.tableflag == 1)
    {
      return <div> <ReactHTMLTableToExcel
                    id="test-table-xls-button"
                    className="download-table-xls-button"
                    table="table-to-xls"
                    filename="Management_Report_By_User"
                    sheet="tablexls"
                    buttonText="Export as Excel"/>&nbsp;
                    <button onClick={this.Exportpdf}>Export as PDF </button>

                    <table id="table-to-xls" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
          <tr role="row" class="pagebreak">
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">No. </th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Structure Name </th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Block Name </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Belong To </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">User Name </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Number Cases</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% Cases</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Co-Ordinator Fee </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Tax Fee </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Other Fee </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Net Fee </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% Net Fee</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Company Income (CI)</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% Company Income</th>
              </tr>
          </thead>
          <tbody>
          {
          this.state.blockfilter.map(
            (data,index) =>
          <tr>
          <td>{++index}</td>
          <td>{data.structure.name}</td>
          <td>{data.name}</td>
          <td>{this.showunderblock(data)}</td>
          {this.showuserinblock(data)}
          <td>{this.shownumbercase(data)}</td>
          <td>{this.showpercentcase(data)}%</td>
          <td>{this.showcoordinatorfee(data)}</td>
          <td>{this.showtaxfee(data)}</td>
          <td>{this.showotherfee(data)}</td>
          <td>{this.shownetfee(data)}</td>
          <td>{this.showpercentnetfee(data)}%</td>
          <td>{this.showcompanyincome(data)}</td>
          <td>{this.showpercentcompanyincome(data)}%</td>

          </tr>
          )}


          </tbody>
          <tfoot>
          <tr class="pagebreak">
          <th colspan=""> </th>
          <th colspan="" style={{backgroundColor:'green'}}> Total Block</th>
          <th colspan="" >{this.state.blockfilter.length}</th>
          <th colspan="" style={{backgroundColor:'orange'}}>Total User	 </th>
          <th colspan="" >{this.state.userauth.length}</th>
          <th colspan="">{this.state.cases.length} </th>
          <th colspan="">100%  </th>
          <th colspan="">  </th>
          <th colspan="">  </th>
          <th colspan="">  </th>
          <th colspan="">{this.showallnetfee()}  </th>
          <th colspan=""> 100%   </th>
          <th colspan=""> {this.showallcompanyincome()} </th>
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
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Number Cases</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% Cases</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Co-Ordinator Fee </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Tax Fee </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Other Fee </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Net Fee </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% Net Fee</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Company Income (CI)</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% Company Income</th>
              </tr>
          </thead>
          <tbody>
          <tr>
          <td colspan="14" style={{textAlign:'center',color:'red',fontSize:'18px'}}><b>ไม่พบข้อมูล</b></td>
          </tr>
          </tbody>
          <tfoot>
          <tr>
          <th colspan=""> </th>
          <th colspan="" style={{backgroundColor:'green'}}> </th>
          <th colspan="" > </th>
          <th colspan="" style={{backgroundColor:'orange'}}></th>
          <th colspan="" > </th>
          <th colspan=""> </th>
          <th colspan=""> </th>
          <th colspan=""> </th>
          <th colspan=""> </th>
          <th colspan=""> </th>
          <th colspan=""> </th>
          <th colspan=""> </th>
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

if (document.getElementById('manageuser')) {
    ReactDOM.render(<ManageUser />, document.getElementById('manageuser'));
}
