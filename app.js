import express from "express";
import userRouter from "./routes/user.js";
const app= express();
app.use(express.json());

app.use("/me",userRouter);

app.listen(3000,()=>{

    console.log("the server is running at the port 3000");
})
