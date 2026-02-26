import {mongoose} from 'mongoose'
import { DB_URL,NODE_ENV } from '../config/env.js'
// import { cache } from 'react'
if(!DB_URL){
    throw new Error('please define MONGODB_URL envroment variable inside .env.<development/>production>.local')
}

const connectiontodatabase=async()=>{
    try{
await mongoose.connect(DB_URL);
console.log(`connecting to dataase in ${process.env.NODE_ENV} mode `)
    } catch(error)
    {
console.error('connecting error:',error);
process.exit(1); 
    }
}
export default connectiontodatabase;