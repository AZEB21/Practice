import{Router } from "express";
import errorHandler from "./middleware/errorHandler.js";

const userRouter=Router();

userRouter.post("/user",(req,res)=>{
   throw new  Error("somthing went wrong");
   
});

userRouter.get("/user/profile",(req,res)=>{
  res.send("there is no user for now");

})
app.use(errorHandler);

export default userRouter;

