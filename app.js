
import { PORT } from './config/env.js';
import express from 'express'
import subscriptionrouter from './routes/subscription.routes.js';
import authrouter from './routes/auth.routes.js';
import userrouter from './routes/user.routes.js';
const app =express();
app.use('/api/v1/auth',authrouter);
app.use('/api/v1/users',userrouter);
app.use('/api/v1/subscriptions',subscriptionrouter);
// const PORT=process.env.PORT || 3000
app.get('/',(req,res)=>{
res.send("Welcom to the subscription API!")
});
app.listen(PORT,()=>{
    console.log(`the port is running at http://localhost:${PORT}`)
});

export default app;