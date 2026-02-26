import { Router } from "express";
const authrouter= Router();
authrouter.post('/sign-up',(req ,res)=>{
    res.send({title:'sing up'})
});
authrouter.post('/sign-in',(req ,res)=>{
    res.send({title:'singin '})
});


authrouter.post('/sign-out',(req ,res)=>{
    res.send({title:'sing out'})
    
});export default authrouter;