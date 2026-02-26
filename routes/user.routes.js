import { Router } from "express";
const userrouter =Router();

userrouter.get('/',(req,res)=> res.send({ title:'GET the user '}));
userrouter.get('/:id',(req,res)=> res.send({ title:'to see the user details  '}));
userrouter.post('/',(req,res)=> res.send({ title:'create the user '}));
userrouter.put('/:id',(req,res)=> res.send({ title:'update the user '}));
userrouter.delete('/:id',(req,res)=> res.send({ title:'delete the user '}));

export default userrouter;