
import { PORT } from './config/env.js';
import express from 'express'

const app =express();
// const PORT=process.env.PORT || 3000
app.get('/',(req,res)=>{
res.send("Welcom to the subscription API!")
});
app.listen(PORT,()=>{
    console.log(`the port is running at http://localhost:${PORT}`)
});

export default app;