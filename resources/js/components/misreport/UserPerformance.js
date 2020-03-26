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
import LineChart from 'react-linechart';
import { Chart } from "react-google-charts";
import ReactHTMLTableToExcel from 'react-html-table-to-excel';
import jsPDF from "jspdf";
import pdfMake from "pdfmake/build/pdfmake";
import pdfFonts from "pdfmake/build/vfs_fonts";
var DateDiff = require('date-diff');
const addSubtractDate = require("add-subtract-date");
import { compareAsc, format } from 'date-fns'

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
export default class UserPerformance extends Component {
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
      typeofdate:0,
      dateingraph:'',
      user:[],
      columntype:'ColumnChart',
      columnchart:['', '', '', '', '', ''],
      rowchart:[['New York City, NY', 8175000, 8008000, 1526000, 1526000, 1517000],
               ['Los Angeles, CA', 3792000, 3694000, 1526000, 1526000, 1517000],
               ['Chicago, IL', 2695000, 2896000, 1526000, 1526000, 1517000],
               ['Houston, TX', 2099000, 1953000, 1526000, 1526000, 1517000],
               ['Philadelphia, PA', 1526000, 1517000, 1526000, 1526000, 1517000]]
    };
    this.Searchclick = this.Searchclick.bind(this);
    this.tableshow = this.tableshow.bind(this);
    this.Exportpdf = this.Exportpdf.bind(this);
    this.filterblockbystructure = this.filterblockbystructure.bind(this);
    this.clickcolumn = this.clickcolumn.bind(this);
    this.clickline = this.clickline.bind(this);
    this.changetypedate = this.changetypedate.bind(this);
  }
  componentDidMount() {
    //console.log("rowchart"+this.state.rowchart);
      setInterval(() => this.forceUpdate(), 1000);


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
  showgraph()
  {
    if(this.state.tableflag == 1)
    {
      let datarow=[];
      const datashow = [
        this.state.columnchart
      //  this.state.block.map(data => data.id )
      ]
      let fromdate;
      let todate;
      switch (this.state.fromdateday) {
        case 'Q1':this.state.fromdateday = '01'
        case 'Q1':this.state.fromdatemonth = '01'
        break;
        case 'Q2':this.state.fromdateday = '01'
        case 'Q2':this.state.fromdatemonth = '04'
        break;
        case 'Q3':this.state.fromdateday = '01'
        case 'Q3':this.state.fromdatemonth = '07'
        break;
        case 'Q4':this.state.fromdateday = '01'
        case 'Q4':this.state.fromdatemonth = '10'
        break;
        case '1-6':this.state.fromdateday = '01'
        case '1-6':this.state.fromdatemonth = '01'
        break;
        case '7-12':this.state.fromdateday = '01'
        case '7-12':this.state.fromdatemonth = '07'
        break;
        default:fromdate = this.state.fromdateday+'/'+this.state.fromdatemonth+'/'+this.state.fromdateyear
      }
      switch (this.state.todateday) {
        case 'Q1':this.state.todateday = '31'
        case 'Q1':this.state.todatemonth = '03'
        break;
        case 'Q2':this.state.todateday = '30'
        case 'Q2':this.state.todatemonth = '06'
        break;
        case 'Q3':this.state.todateday = '30'
        case 'Q3':this.state.todatemonth = '09'
        break;
        case 'Q4':this.state.todateday = '31'
        case 'Q4':this.state.todatemonth = '12'
        break;
        case '1-6':this.state.todateday = '30'
        case '1-6':this.state.todatemonth = '06'
        break;
        case '7-12':this.state.todateday = '31'
        case '7-12':this.state.todatemonth = '12'
        break;
        default:todate = this.state.todateday+'/'+this.state.todatemonth+'/'+this.state.todateyear
      }
      switch (this.state.typeofdate) {
        case '3':this.state.fromdateday = '01'
        case '3':this.state.todateday = '31'
        break;
        case '6':this.state.fromdateday = '01'
        case '6':this.state.fromdatemonth = '01'
        case '6':this.state.todateday = '31'
        case '6':this.state.todatemonth = '12'
        break;
        default:todate = this.state.todateday+'/'+this.state.todatemonth+'/'+this.state.todateyear
      }
      //console.log("FromDatee"+this.state.fromdateday+''+this.state.fromdatemonth+''+this.state.fromdateyear)

      //console.log("Datee"+this.state.todateday+''+this.state.todatemonth+''+this.state.todateyear)
      var date1 = new Date(this.state.fromdateyear, this.state.fromdatemonth-1, this.state.fromdateday); // 2015-12-1
      var date2 = new Date(this.state.todateyear, this.state.todatemonth-1, this.state.todateday); // 2014-01-1
      //console.log("date1"+date1)
      //console.log("date2"+date2)

      var diff = new DateDiff(date2, date1);
      //console.log(diff.months()); // ===> 1.9
      if(this.state.typeofdate == 1)
      {
        let sumall;
        let sh = []
        //console.log(this.state.columnchart)
        for (var i=0; i <= diff.days(); i++)
        {
          let filblockcommis
          var show
          var d = new Date(this.state.fromdateyear-543, this.state.fromdatemonth-1, this.state.fromdateday);
          var dd = new Date(addSubtractDate.add(d, i, "days"))
          //console.log("dayyyyy"+i+" "+dd.getDay())
          var date = format(dd,'dd MMM yyyy')
          var datetocompare = format(dd,'dd/MM/yyyy')

          //console.log("ddddddd"+i+" "+dd)
          //console.log("dd.getMonth()"+i+" "+(dd.getMonth()+1))

          //console.log("Day",i,dd.getDay(),"Month",dd.getMonth(),"year",dd.getFullYear())

          show = [date];
          sh.push("No."+i+"day"+" "+date)
          for (var i2=1; i2 <= this.state.columnchart.length-1; i2++)
          {
            var blockcommis;
            blockcommis = this.state.cases.filter((cases) => {
             return cases.cases.block.structure.name == this.state.columnchart[i2]
           })
            let result = [];
            filblockcommis = blockcommis.filter((cases) => {
              let filday = cases.cases.finish_date.split('/')[0]
              let filmonth = cases.cases.finish_date.split('/')[1]
              let filyear = cases.cases.finish_date.split('/')[2]
              var filtocompare = filday+'/'+filmonth+'/'+(Number(filyear)-543)
              //console.log("filtocompare"+filtocompare)
              return filtocompare == datetocompare
           })
           //console.log('filblockcommis2'+filblockcommis)
         //   const var5 = blockcommis.map(data =>  //console.log(data.cases.case_created_date.split('/')[1]) )
            let sum= filblockcommis.map(data =>result.push(data.offer.offer_payment_value19));
            if(result.length>0)
            {
               sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
              // sumall =  sumall.toFixed(2);
            }
            else if(sumall=='')
            {
               sumall = 0;
            }
            else
            {
               sumall = 0;
            }
            sumall = parseFloat(sumall)
            //console.log(this.state.columnchart[i2]+" "+sumall)
            show.push(sumall);
          }
          //console.log("sh"+sh)

          //console.log("show"+show)
          datashow.push(show)
         }

      }
      if(this.state.typeofdate == 3)
      {
        let sumall;
        let sh = []
        //console.log("HI"+diff.months())
        for (var i=0; i <= diff.months()-1; i++)
        {

          let filblockcommis
          var show
          var d = new Date(this.state.fromdateyear-543, this.state.fromdatemonth-1, this.state.fromdateday);
          var dd = new Date(addSubtractDate.add(d, i, "months"))

          var date = format(new Date(addSubtractDate.add(d, i, "months")),'MMM yyyy')
          //console.log("ddddddd"+i+" "+dd)
          //console.log("dd.getMonth()"+i+" "+(dd.getMonth()+1))

          //console.log("Month",dd.getMonth(),"year",dd.getFullYear())
          var getmonth = dd.getMonth()+1;
          var showdate
          if(getmonth == 1){showdate = "Jan"}else if(getmonth == 2){showdate = "Feb"}
          else if(getmonth == 3){showdate = "Mar"}else if(getmonth == 4){showdate = "Apr"}
          else if(getmonth == 5){showdate = "May"}else if(getmonth == 6){showdate = "Jun"}
          else if(getmonth == 7){showdate = "Jul"}else if(getmonth == 8){showdate = "Aug"}
          else if(getmonth == 9){showdate = "Sep"}else if(getmonth == 10){showdate = "Oct"}
          else if(getmonth == 11){showdate = "Nov"}else if(getmonth == 12){showdate = "Dec"}
          else
          {
            showdate = dd.getMonth()
          }
          show = [showdate+" "+dd.getFullYear()];
          sh.push("No."+i+"day"+" "+date)
          for (var i2=1; i2 <= this.state.columnchart.length-1; i2++)
          {
            var blockcommis;
            blockcommis = this.state.cases.filter((cases) => {
             return cases.cases.block.structure.name == this.state.columnchart[i2]
           })
            let result = [];
            filblockcommis = blockcommis.filter((cases) => {
              let filmonth = cases.cases.finish_date.split('/')[1]
              let filyear = cases.cases.finish_date.split('/')[2]
              return cases.cases.finish_date.split('/')[1] == getmonth && cases.cases.finish_date.split('/')[2]-543 == dd.getFullYear()
           })
           //console.log('filblockcommis2'+filblockcommis)
         //   const var5 = blockcommis.map(data =>  //console.log(data.cases.case_created_date.split('/')[1]) )
            let sum= filblockcommis.map(data =>result.push(data.offer.offer_payment_value19));
            if(result.length>0)
            {
               sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
               sumall =  sumall.toFixed(2);
            }
            else if(sumall=='')
            {
               sumall = 0;
               sumall =  sumall.toFixed(2);
            }
            else
            {
               sumall = 0;
               sumall =  sumall.toFixed(2);
            }
            sumall = parseFloat(sumall)
            //console.log(this.state.columnchart[i2]+" "+sumall)
            show.push(sumall);
          }
          //console.log("show"+show)
          datashow.push(show)
        }
        //console.log("sh"+sh)

      }
      if(this.state.typeofdate == 4)
      {
        let arrshow = [];
        let sumall;
        let createdate = [];
        let blockcommisarray = [];

        //console.log("Heyy"+arrshow)

          for (var i2=0; i2 < diff.months()/3; i2++) {

            var d = new Date(this.state.fromdateyear-543, this.state.fromdatemonth-1, this.state.fromdateday);
            var dd;
            var quarter
            var year
            var show
            var test
            let filblockcommis
            if(i2 == 0)
            {
               dd = new Date(addSubtractDate.add(d, i2, "months"));
               //console.log("HII"+dd);
                quarter = Math.floor((dd.getMonth() + 3) / 3);
                year = format(new Date(dd),'yyyy')
                 show = ["Quater"+quarter+' '+year];
                 for (var i=1; i <= this.state.columnchart.length-1; i++)
                 {
                   var blockcommis;
                   blockcommis = this.state.cases.filter((cases) => {
                    return cases.cases.block.structure.name == this.state.columnchart[i]
                  })
                   let result = [];
                    filblockcommis = blockcommis.filter((cases) => {
                      let filmonth = cases.cases.finish_date.split('/')[1]
                      let filyear = cases.cases.finish_date.split('/')[2]-543
                      filmonth = parseInt(filmonth/3) + 1
                      return filmonth == quarter && cases.cases.finish_date.split('/')[2]-543 == year
                  })
                  //console.log('filblockcommis1'+filblockcommis)

                //   const var5 = blockcommis.map(data =>  //console.log(data.cases.case_created_date.split('/')[1]) )
                   let sum= filblockcommis.map(data =>result.push(data.offer.offer_payment_value19));
                   if(result.length>0)
                   {
                      sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
                      sumall =  sumall.toFixed(2);
                   }
                   else if(sumall=='')
                   {
                      sumall = 0;
                      sumall =  sumall.toFixed(2);
                   }
                   else
                   {
                      sumall = 0;
                      sumall =  sumall.toFixed(2);
                   }
                   sumall = parseFloat(sumall)
                   //console.log(this.state.columnchart[i]+" "+sumall)
                   show.push(sumall);
                 }
                 //console.log("show"+show)

            }
            else
            {
               dd = new Date(addSubtractDate.add(d, i2*3, "months"));
               quarter = Math.floor((dd.getMonth() + 3) / 3);
               year = format(new Date(dd),'yyyy')
               show = ["Quater"+quarter+' '+year];
               for (var i=1; i <= this.state.columnchart.length-1; i++)
               {
                 var blockcommis;
                 blockcommis = this.state.cases.filter((cases) => {
                  return cases.cases.block.structure.name == this.state.columnchart[i]
                })
                 let result = [];
                 filblockcommis = blockcommis.filter((cases) => {
                   let filmonth = cases.cases.finish_date.split('/')[1]
                   let filyear = cases.cases.finish_date.split('/')[2]-543
                   filmonth = parseInt(filmonth/3) + 1
                   return filmonth == quarter && cases.cases.finish_date.split('/')[2]-543 == year
                })
                //console.log('filblockcommis2'+filblockcommis)
              //   const var5 = blockcommis.map(data =>  //console.log(data.cases.case_created_date.split('/')[1]) )
                 let sum= filblockcommis.map(data =>result.push(data.offer.offer_payment_value19));
                 if(result.length>0)
                 {
                    sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
                    sumall =  sumall.toFixed(2);
                 }
                 else if(sumall=='')
                 {
                    sumall = 0;
                    sumall =  sumall.toFixed(2);
                 }
                 else
                 {
                    sumall = 0;
                    sumall =  sumall.toFixed(2);
                 }
                 sumall = parseFloat(sumall)
                 //console.log(this.state.columnchart[i]+" "+sumall)
                 show.push(sumall);
               }
            }

            //console.log("show"+show)
            for (var i=1; i <= this.state.columnchart.length; i++)
            {
              //console.log(this.state.columnchart[i])
              var blockcommis;
              blockcommis = this.state.cases.filter((cases) => {
               return cases.cases.block.structure.name == this.state.columnchart[i]
             })
             blockcommisarray.push(blockcommis)
              let result = [];
            //  const var5 = blockcommis.map(data =>  //console.log(data.cases.case_created_date.split('/')[1]) )
              let sum= blockcommis.map(data =>result.push(data.offer.offer_payment_value19));
              if(result.length>0)
              {
                 sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
                 sumall =  sumall.toFixed(2);
              }
              else
              {
                 sumall = 0;
              }
              blockcommis.map(data =>createdate.push(data.cases.case_created_date));
              arrshow.push(sumall)
            }
            //console.log("blockcommis"+blockcommisarray)
            datashow.push(show)

        }
      }


      if(this.state.typeofdate == 5)
      {
        let arrshow = [];
        let sumall;
        let createdate = [];
        let blockcommisarray = [];

        //console.log("Heyy"+arrshow)

          for (var i2=0; i2 < diff.months()/6; i2++) {

            var d = new Date(this.state.fromdateyear-543, this.state.fromdatemonth-1, this.state.fromdateday);
            var dd;
            var quarter
            var year
            var show
            var test
            let filblockcommis
            if(i2 == 0)
            {
               dd = new Date(addSubtractDate.add(d, i2, "months"));
               //console.log("HII"+dd);
                quarter = Math.floor((dd.getMonth() + 6) / 6);
                year = format(new Date(dd),'yyyy')
                show = ["H"+quarter+' '+year];
                 for (var i=1; i <= this.state.columnchart.length-1; i++)
                 {
                   var blockcommis;
                   blockcommis = this.state.cases.filter((cases) => {
                    return cases.cases.block.structure.name == this.state.columnchart[i]
                  })
                   let result = [];
                    filblockcommis = blockcommis.filter((cases) => {
                      let filmonth = cases.cases.finish_date.split('/')[1]
                      let filyear = cases.cases.finish_date.split('/')[2]-543
                      filmonth = parseInt(filmonth/6) + 1
                      return filmonth == quarter && cases.cases.finish_date.split('/')[2]-543 == year
                  })
                  //console.log('filblockcommis1'+filblockcommis)
                   let sum= filblockcommis.map(data =>result.push(data.offer.offer_payment_value19));
                   if(result.length>0)
                   {
                      sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
                      sumall =  sumall.toFixed(2);
                   }
                   else if(sumall=='')
                   {
                      sumall = 0;
                      sumall =  sumall.toFixed(2);
                   }
                   else
                   {
                      sumall = 0;
                      sumall =  sumall.toFixed(2);
                   }
                   sumall = parseFloat(sumall)
                   //console.log(this.state.columnchart[i]+" "+sumall)
                   show.push(sumall);
                 }
                 //console.log("show"+show)
            }
            else
            {
               dd = new Date(addSubtractDate.add(d, i2*6, "months"));
               quarter = Math.floor((dd.getMonth() + 6) / 6);
               year = format(new Date(dd),'yyyy')
               show = ["H"+quarter+' '+year];
               for (var i=1; i <= this.state.columnchart.length-1; i++)
               {
                 var blockcommis;
                 blockcommis = this.state.cases.filter((cases) => {
                  return cases.cases.block.structure.name == this.state.columnchart[i]
                })
                 let result = [];
                 filblockcommis = blockcommis.filter((cases) => {
                   let filmonth = cases.cases.finish_date.split('/')[1]
                   let filyear = cases.cases.finish_date.split('/')[2]-543
                   filmonth = parseInt(filmonth/6) + 1
                   return filmonth == quarter && cases.cases.finish_date.split('/')[2]-543 == year
                })
                //console.log('filblockcommis2'+filblockcommis)
              //   const var5 = blockcommis.map(data =>  //console.log(data.cases.case_created_date.split('/')[1]) )
                 let sum= filblockcommis.map(data =>result.push(data.offer.offer_payment_value19));
                 if(result.length>0)
                 {
                    sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
                    sumall =  sumall.toFixed(2);
                 }
                 else if(sumall=='')
                 {
                    sumall = 0;
                    sumall =  sumall.toFixed(2);
                 }
                 else
                 {
                    sumall = 0;
                    sumall =  sumall.toFixed(2);
                 }
                 sumall = parseFloat(sumall)
                 //console.log(this.state.columnchart[i]+" "+sumall)
                 show.push(sumall);
               }
            }

            //console.log("show"+show)
            for (var i=1; i <= this.state.columnchart.length; i++)
            {
              //console.log(this.state.columnchart[i])
              var blockcommis;
              blockcommis = this.state.cases.filter((cases) => {
               return cases.cases.block.structure.name == this.state.columnchart[i]
             })
             blockcommisarray.push(blockcommis)
              let result = [];
            //  const var5 = blockcommis.map(data =>  //console.log(data.cases.case_created_date.split('/')[1]) )
              let sum= blockcommis.map(data =>result.push(data.offer.offer_payment_value19));
              if(result.length>0)
              {
                 sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
                 sumall =  sumall.toFixed(2);
              }
              else
              {
                 sumall = 0;
              }
              blockcommis.map(data =>createdate.push(data.cases.case_created_date));
              arrshow.push(sumall)
            }
            //console.log("blockcommis"+blockcommisarray)
            datashow.push(show)

        }
      }
      if(this.state.typeofdate == 6)
      {
        let arrshow = [];
        let sumall;
        let createdate = [];
        let blockcommisarray = [];

        //console.log("Heyy"+arrshow)

          for (var i2=0; i2 < diff.months()/12; i2++) {

            var d = new Date(this.state.fromdateyear-543, this.state.fromdatemonth-1, this.state.fromdateday);
            var dd;
            var quarter
            var year
            var show
            var test
            let filblockcommis
            if(i2 == 0)
            {
               dd = new Date(addSubtractDate.add(d, i2, "months"));
               //console.log("HII"+dd);
                quarter = Math.floor((dd.getMonth() + 12) / 12);
                year = format(new Date(dd),'yyyy')
                 show = [year];
                 for (var i=1; i <= this.state.columnchart.length-1; i++)
                 {
                   var blockcommis;
                   blockcommis = this.state.cases.filter((cases) => {
                    return cases.cases.block.structure.name == this.state.columnchart[i]
                  })
                   let result = [];
                    filblockcommis = blockcommis.filter((cases) => {
                      let filyear = cases.cases.finish_date.split('/')[2]-543
                      return cases.cases.finish_date.split('/')[2]-543 == year
                  })
                  //console.log('filblockcommis1'+filblockcommis)

                //   const var5 = blockcommis.map(data =>  //console.log(data.cases.case_created_date.split('/')[1]) )
                   let sum= filblockcommis.map(data =>result.push(data.offer.offer_payment_value19));
                   if(result.length>0)
                   {
                      sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
                      sumall =  sumall.toFixed(2);
                   }
                   else if(sumall=='')
                   {
                      sumall = 0;
                      sumall =  sumall.toFixed(2);
                   }
                   else
                   {
                      sumall = 0;
                      sumall =  sumall.toFixed(2);
                   }
                   sumall = parseFloat(sumall)
                   //console.log(this.state.columnchart[i]+" "+sumall)
                   show.push(sumall);
                 }
                 //console.log("show"+show)

            }
            else
            {
               dd = new Date(addSubtractDate.add(d, i2*12, "months"));
               quarter = Math.floor((dd.getMonth() + 12) / 12);
               year = format(new Date(dd),'yyyy')
               show = [year];
               for (var i=1; i <= this.state.columnchart.length-1; i++)
               {
                 var blockcommis;
                 blockcommis = this.state.cases.filter((cases) => {
                  return cases.cases.block.structure.name == this.state.columnchart[i]
                })
                 let result = [];
                 filblockcommis = blockcommis.filter((cases) => {
                   let filyear = cases.cases.finish_date.split('/')[2]-543
                   return cases.cases.finish_date.split('/')[2]-543 == year
                })
                //console.log('filblockcommis2'+filblockcommis)
              //   const var5 = blockcommis.map(data =>  //console.log(data.cases.case_created_date.split('/')[1]) )
                 let sum= filblockcommis.map(data =>result.push(data.offer.offer_payment_value19));
                 if(result.length>0)
                 {
                    sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
                    sumall =  sumall.toFixed(2);
                 }
                 else if(sumall=='')
                 {
                    sumall = 0;
                    sumall =  sumall.toFixed(2);
                 }
                 else
                 {
                    sumall = 0;
                    sumall =  sumall.toFixed(2);
                 }
                 sumall = parseFloat(sumall)
                 //console.log(this.state.columnchart[i]+" "+sumall)
                 show.push(sumall);
               }
            }

            //console.log("show"+show)
            for (var i=1; i <= this.state.columnchart.length; i++)
            {
              //console.log(this.state.columnchart[i])
              var blockcommis;
              blockcommis = this.state.cases.filter((cases) => {
               return cases.cases.block.structure.name == this.state.columnchart[i]
             })
             blockcommisarray.push(blockcommis)
              let result = [];
            //  const var5 = blockcommis.map(data =>  //console.log(data.cases.case_created_date.split('/')[1]) )
              let sum= blockcommis.map(data =>result.push(data.offer.offer_payment_value19));
              if(result.length>0)
              {
                 sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
                 sumall =  sumall.toFixed(2);
              }
              else
              {
                 sumall = 0;
              }
              blockcommis.map(data =>createdate.push(data.cases.case_created_date));
              arrshow.push(sumall)
            }
            //console.log("blockcommis"+blockcommisarray)
            datashow.push(show)
        }
      }
    return    <div> <div style={{textAlign:'center'}}>
    <a className="btn btn-primary btn-margin" onClick={this.clickcolumn}>Column Chart</a>
        <a className="btn btn-warning btn-margin" onClick={this.clickline}>Line Chart</a></div>

        <Chart
        height={500}
        chartType={this.state.columntype}
        loader={<div>Loading Chart</div>}
        data={datashow}
        options={{
          title: 'User Perfomance',

          hAxis: {
            title: 'Date',
            minValue: 0,
          },
          vAxis: {
            title: 'Income',
          },
        }}
        legendToggle
      />
      </div>

    }
    else
    {

    }
  }
  changetypedate(e)
  {
    var today = new Date()
    let date =   today.getDate()+'/'+(today.getMonth() + 1)+ '/'+(today.getFullYear()+543);
    //console.log(e.target.value)
  this.setState({typeofdate:e.target.value,tableflag:0})
  }
  clickcolumn()
  {
    this.setState({columntype:'ColumnChart',
});

  }
  clickline()
  {
    this.setState({columntype:'LineChart',
});

  }
  showfromdatetodate()
  {
    if(this.state.typeofdate == 3)
    {
      return <div><div className="column5">
      <div className="card">
      <div className="card-header">
      <b>จากเดือนที่</b>
      </div>
      <div className="card-body">
      <select  className="form-control" onChange={(e) => this.setState({ fromdatemonth: e.target.value })}>
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
      <select className="form-control" onChange={(e) => this.setState({ fromdateyear: e.target.value })}  >
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
      <div className="column5">
      <div className="card">
      <div className="card-header">
      <b>ถึงเดือนที่</b>
      </div>
      <div className="card-body">
      <select  className="form-control" onChange={(e) => this.setState({ todatemonth: e.target.value })}>
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
    <select className="form-control" onChange={(e) => this.setState({ todateyear: e.target.value })}  >
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
      </div>
    }
      if(this.state.typeofdate == 4)
      {
        return <div><div className="column5">
        <div className="card">
        <div className="card-header">
        <b>จากควอเตอร์</b>
        </div>
        <div className="card-body">
        <select className="form-control" onChange={(e) => this.setState({ fromdateday: e.target.value })} name="dayex">
    <option value ="">  โปรดเลือก  </option>
    <option value ="Q1" >  Q1  </option>
    <option value ="Q2" >  Q2  </option>
    <option value ="Q3" >  Q3  </option>
    <option value ="Q4" >  Q4  </option>
      </select>
      <select className="form-control" onChange={(e) => this.setState({ fromdateyear: e.target.value })}  >
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
        <div className="column5">
        <div className="card">
        <div className="card-header">
        <b>ถึงควอเตอร์</b>
        </div>
        <div className="card-body">
        <select className="form-control" onChange={(e) => this.setState({ todateday: e.target.value })} name="dayex">
        <option value ="">  โปรดเลือก  </option>
        <option value ="Q1" >  Q1  </option>
        <option value ="Q2" >  Q2  </option>
        <option value ="Q3" >  Q3  </option>
        <option value ="Q4" >  Q4  </option>
        </select>
      <select className="form-control" onChange={(e) => this.setState({ todateyear: e.target.value })}  >
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
        </div>
      }
      if(this.state.typeofdate == 5)
      {
        return <div><div className="column5">
        <div className="card">
        <div className="card-header">
        <b>จากเดือนที่</b>
        </div>
        <div className="card-body">
        <select className="form-control" onChange={(e) => this.setState({ fromdateday: e.target.value })} name="dayex">
    <option value ="">  โปรดเลือก  </option>
    <option value ="1-6" >  1-6  </option>
    <option value ="7-12" >  7-12  </option>

      </select>
      <select className="form-control" onChange={(e) => this.setState({ fromdateyear: e.target.value })}  >
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
        <div className="column5">
        <div className="card">
        <div className="card-header">
        <b>ถึงเดือนที่</b>
        </div>
        <div className="card-body">
        <select className="form-control" onChange={(e) => this.setState({ todateday: e.target.value })} name="dayex">
    <option value ="">  โปรดเลือก  </option>
    <option value ="1-6" >  1-6  </option>
    <option value ="7-12" >  7-12  </option>

      </select>
      <select className="form-control" onChange={(e) => this.setState({ todateyear: e.target.value })}  >
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
        </div>
      }
      if(this.state.typeofdate == 6)
      {
        return <div><div className="column5">
        <div className="card">
        <div className="card-header">
        <b>จากปี</b>
        </div>
        <div className="card-body">
      <select className="form-control" onChange={(e) => this.setState({ fromdateyear: e.target.value })}  >
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
        <div className="column5">
        <div className="card">
        <div className="card-header">
        <b>ถึงปี</b>
        </div>
        <div className="card-body">

      <select className="form-control" onChange={(e) => this.setState({ todateyear: e.target.value })}  >
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
        </div>
      }
      else
      {
      return <div><div className="column5">
      <div className="card">
      <div className="card-header">
      <b>จากวันที่</b>
      </div>
      <div className="card-body">
      <select className="form-control" onChange={(e) => this.setState({ fromdateday: e.target.value })} name="dayex">
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

    <select  className="form-control" onChange={(e) => this.setState({ fromdatemonth: e.target.value })}>
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
  <select className="form-control" onChange={(e) => this.setState({ fromdateyear: e.target.value })}  >
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
      <div className="column5">
      <div className="card">
      <div className="card-header">
      <b>ถึงวันที่</b>
      </div>
      <div className="card-body">
      <select className="form-control" onChange={(e) => this.setState({ todateday: e.target.value })} name="dayex">
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

    <select  className="form-control" onChange={(e) => this.setState({ todatemonth: e.target.value })}>
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
  <select className="form-control" onChange={(e) => this.setState({ todateyear: e.target.value })}  >
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
      </div>
    }

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
    axios.get('/wealththaiinsurance/report/getuserinstructure?filterstructure'+e.target.value).then(response=>{
      this.setState({user:response.data});
    })
  }
  Exportpdf()
  {
    var bodyData = [];
    bodyData.push([ {text:'No.',fillColor:'silver'}, {text:'Structure Name',fillColor:'silver'}, {text:'Block Name',fillColor:'silver'}, {text:'Belong To',fillColor:'silver'}, {text:'Block Commission',fillColor:'silver'}, {text:'% Income',fillColor:'silver'}]);
    this.state.blockfilter.forEach((data,index) => {
      var dataRow = [];
    //  dataRow.push([ 'No.', 'Structure Name', 'Block Name', 'Belong To', 'User Name', 'Total Cases', '% Cases'] )
      dataRow.push(++index);
      dataRow.push(data.structure.name);
      dataRow.push(data.name);
      dataRow.push(this.showunderblockpdf(data));
      dataRow.push(this.showcasecominblock(data));
      dataRow.push(this.showcaseincomeinblock(data));
      bodyData.push(dataRow)
    });
    bodyData.push([ '', {text:'Total Number of Block',fillColor:'green'}, this.state.blockfilter.length,'', this.state.allblockcommission, '100%']);
    let header = "User Performance Report"
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
                     body:bodyData,
                     alignment:'center'
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
    let fromdate;
    let todate;
    switch (this.state.fromdateday) {
      case 'Q1':fromdate = '01/01/'+this.state.fromdateyear
      case 'Q2':fromdate = '01/04/'+this.state.fromdateyear
      case 'Q3':fromdate = '01/07/'+this.state.fromdateyear
      case 'Q4':fromdate = '01/10/'+this.state.fromdateyear
      case '1-6':fromdate = '01/01/'+this.state.fromdateyear
      case '7-12':fromdate = '01/07/'+this.state.fromdateyear
        break;
      default:fromdate = this.state.fromdateday+'/'+this.state.fromdatemonth+'/'+this.state.fromdateyear
    }
    switch (this.state.todateday) {
      case 'Q1':todate = '31/01/'+this.state.todateyear
      case 'Q2':todate = '30/04/'+this.state.todateyear
      case 'Q3':todate = '31/07/'+this.state.todateyear
      case 'Q4':todate = '31/10/'+this.state.todateyear
      case '1-6':todate = '30/06/'+this.state.todateyear
      case '7-12':todate = '31/12/'+this.state.todateyear
        break;
      default:todate = this.state.todateday+'/'+this.state.todatemonth+'/'+this.state.todateyear
    }
    switch (this.state.typeofdate) {
      case '3':this.state.fromdateday = '01'
      case '3':this.state.todateday = '31'
      break;
      case '6':this.state.fromdateday = '01'
      case '6':this.state.fromdatemonth = '01'
      case '6':this.state.todateday = '31'
      case '6':this.state.todatemonth = '12'
      break;
      default:todate = this.state.todateday+'/'+this.state.todatemonth+'/'+this.state.todateyear
    }
    axios.post('/wealththaiinsurance/report/filterblockbyuser',{
      fromdate:fromdate,
      todate:todate,
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
    axios.post('/wealththaiinsurance/report/getcolumnchart',{
      fromdate:this.state.fromdateday+'/'+this.state.fromdatemonth+'/'+this.state.fromdateyear,
      todate:this.state.todateday+'/'+this.state.todatemonth+'/'+this.state.todateyear,
      blockid:this.state.blockid,
      underblock:this.state.underblock,
    }).then(res=>{
      //console.log(res.data);
        this.setState({
          columnchart:res.data
        })
        //console.log("column"+res.data);
    });
    axios.post('/wealththaiinsurance/report/filtercasebyuser',{
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
      let sumall;
      let result = [];
      let allblock;
      let sum = this.state.cases.map(data =>result.push(data.offer.offer_payment_value19));
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
      let ans
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
     return sumall;
    }
    showuserinblock(data)
    {
      this.state.userinblock = this.state.userauth.filter((userauth) => {
       return userauth.block_id == data.block_id
     })
     if(this.state.userinblock == null ||this.state.userinblock == 0 ||this.state.userinblock == '' )
     {
       return <td></td>
     }
     else
     {
       return <td>{this.state.userinblock.map(name =><p>{name.user.firstname} </p>)}</td>
     }
    }
    showuserinblockpdf(sourceRow)
    {
      this.state.userinblock = this.state.userauth.filter((userauth) => {
       return userauth.block_id == sourceRow.block_id
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
      return <td>{data.belongtoblock.name}</td>

    }
  }
  tableshow()
  {
    if(this.state.tableflag == 0)
    {
      return <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
          <tr role="row">
          <th   tabIndex="0" aria-controls="example2" rowSpan="1" colSpan="1" aria-label="port: activate to sort column ascending">No. </th>
            <th   tabIndex="0" aria-controls="example2" rowSpan="1" colSpan="1" aria-label="port: activate to sort column ascending">Structure Name </th>
            <th   tabIndex="0" aria-controls="example2" rowSpan="1" colSpan="1" aria-label="port: activate to sort column ascending">Block Name </th>
              <th   tabIndex="0" aria-controls="example2" rowSpan="1" colSpan="1" aria-label="port: activate to sort column ascending">Belong To </th>
              <th   tabIndex="0" aria-controls="example2" rowSpan="1" colSpan="1" aria-label="port: activate to sort column ascending">Block Commission </th>
              <th   tabIndex="0" aria-controls="example2" rowSpan="1" colSpan="1" aria-label="port: activate to sort column ascending">% Income </th>

              </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
          <tr>
          <th colSpan=""> </th>
          <th colSpan=""></th>
          <th colSpan="" > </th>
          <th colSpan="" > </th>
          <th colSpan="" > </th>
          <th colSpan=""> </th>
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
                    filename="user_performance_report"
                    sheet="tablexls"
                    buttonText="Export as Excel"/>&nbsp;
                    <button onClick={this.Exportpdf}>Export as PDF </button>

                    <table id="table-to-xls" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
          <tr role="row" className="pagebreak">
          <th   tabIndex="0" aria-controls="example2" rowSpan="1" colSpan="1" aria-label="port: activate to sort column ascending">No. </th>
            <th   tabIndex="0" aria-controls="example2" rowSpan="1" colSpan="1" aria-label="port: activate to sort column ascending">Structure Name </th>
            <th   tabIndex="0" aria-controls="example2" rowSpan="1" colSpan="1" aria-label="port: activate to sort column ascending">Block Name </th>
              <th   tabIndex="0" aria-controls="example2" rowSpan="1" colSpan="1" aria-label="port: activate to sort column ascending">Belong To </th>
              <th   tabIndex="0" aria-controls="example2" rowSpan="1" colSpan="1" aria-label="port: activate to sort column ascending">Block Commission </th>
              <th   tabIndex="0" aria-controls="example2" rowSpan="1" colSpan="1" aria-label="port: activate to sort column ascending">% Income </th>
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
          {this.showunderblock(data)}
          <td>{this.showcasecominblock(data)}</td>
          <td>{this.showcaseincomeinblock(data)}%</td>
          </tr>
          )}

          </tbody>
          <tfoot>
          <tr className="pagebreak">
          <th colSpan=""> </th>
          <th colSpan="" style={{backgroundColor:'green'}}> Total Number of Block</th>
          <th colSpan="" >{this.state.blockfilter.length}</th>
          <th colSpan="" > </th>
          <th colSpan="">{this.state.allblockcommission} </th>
          <th colSpan=""> 100% </th>
          </tr>
          </tfoot>
          </table>

          </div>
    }
    else if(this.state.tableflag == 2)
    {
      return <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
          <tr role="row">
          <th   tabIndex="0" aria-controls="example2" rowSpan="1" colSpan="1" aria-label="port: activate to sort column ascending">No. </th>
            <th   tabIndex="0" aria-controls="example2" rowSpan="1" colSpan="1" aria-label="port: activate to sort column ascending">Structure Name </th>
            <th   tabIndex="0" aria-controls="example2" rowSpan="1" colSpan="1" aria-label="port: activate to sort column ascending">Block Name </th>
              <th   tabIndex="0" aria-controls="example2" rowSpan="1" colSpan="1" aria-label="port: activate to sort column ascending">Belong To </th>
              <th   tabIndex="0" aria-controls="example2" rowSpan="1" colSpan="1" aria-label="port: activate to sort column ascending">Block Commission </th>
              <th   tabIndex="0" aria-controls="example2" rowSpan="1" colSpan="1" aria-label="port: activate to sort column ascending">% Income </th>
              </tr>
          </thead>
          <tbody>
          <tr>
          <td colSpan="6" style={{textAlign:'center',color:'red',fontSize:'18px'}}><b>ไม่พบข้อมูล</b></td>
          </tr>
          </tbody>
          <tfoot>
          <tr>
          <th colSpan=""> </th>
          <th colSpan=""> </th>
          <th colSpan="" > </th>
          <th colSpan="" > </th>
          <th colSpan="" > </th>
          <th colSpan=""> </th>
          <th colSpan=""> </th>
          </tr>
          </tfoot>
          </table>
    }
  }
    render() {


      return (
            <div>
            <div className="row">
            <div className="column5">
            <div className="card">
            <div className="card-header">
            <b>เลือกรูปแบบวันที่</b>
            </div>
            <div className="card-body">
              <select className="form-control" onChange={this.changetypedate}>
                                         <option value="0">โปรดเลือก</option>
                                         <option value="1">Daily</option>
                                         <option value="3">Monthly</option>
                                         <option value="4">Quaterly</option>
                                         <option value="5">Half Year</option>
                                         <option value="6">Yearly</option>
              </select><br/><br/>        &nbsp;
            </div>
            </div>
            </div>
            {this.showfromdatetodate()}
            <div className="column5">
            <div className="card">
            <div className="card-header">
            <b>เลือกStructure</b>
            </div>
            <div className="card-body">
            <select className="form-control " id="autowidth"  onChange={this.filterblockbystructure}>
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
            <div className="column5">
            <div className="card">
            <div className="card-header">
            <b>เลือกผู้แจ้งงาน</b>
            </div>
            <div className="card-body">
            <select className="form-control " id="autowidth"  onChange={(e) => this.setState({ blockid: e.target.value })}>
            <option>กรุณาเลือกผู้แจ้งงาน</option>
            {
              this.state.user.map(
                data =>
                <option value={data.id}  >{data.firstname} {data.lastname}</option>
              )
            }
              </select><br/><br/>
              ดูทุกคนที่อยู่ภายใต้คนนี <select onChange={(e) => this.setState({ underblock: e.target.value })}><option value="0">ไม่</option><option value="1">ใช่</option></select>
            </div>
            </div>
            </div>
            </div>
            <button style={{float:'right'}} type="submit" className="btn btn-primary" onClick={this.Searchclick}>
              <span className="glyphicon glyphicon-search" aria-hidden="true"></span>
              ค้นหา
            </button><br/><br/>
            <div style={{overflowX:'auto'}}>

            {this.tableshow()}
            </div>

    <div className={"my-pretty-chart-container"}>


    <br/>
    {this.showgraph()}


                          </div>
            </div>
        );
    }
}

if (document.getElementById('userperformance')) {
    ReactDOM.render(<UserPerformance />, document.getElementById('userperformance'));
}
