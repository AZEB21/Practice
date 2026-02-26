import {Router} from 'express';
 const subscriptionrouter= Router();
  subscriptionrouter.get('/',(req,res)=> res.send({title:'GET all the subscription'}));
  subscriptionrouter.get('/:id',(req,res)=> res.send({title:'GET  subscription details '}));
  subscriptionrouter.get('/user/:id',(req,res)=> res.send({title:'GET all  the user  subscription'}));
  subscriptionrouter.post('/',(req,res)=> res.send({title:'create the subscription'}));
  subscriptionrouter.put ('/:id',(req,res)=> res.send({title:'update the subscription'}));
  subscriptionrouter.delete('/:id',(req,res)=> res.send({title:'delete the subscription'}));
  subscriptionrouter.get('/upcoming-renwals',(req,res)=> res.send({title:'delete the subscription'}));

  export default subscriptionrouter;