function addScript(fileName)
{
    var scriptTag=document.createElement('script');
    scriptTag.setAttribute("type","text/javascript");
    scriptTag.setAttribute("src", fileName);
    document.getElementsByTagName("body")[0].appendChild(scriptTag);
   // alert(scriptTag);
}
function init()
{
    console.log("loading controllers...");
    addScript("Controllers/Dashboard/dashBoardController.js");
    addScript("Controllers/Customers/customerController.js");
    addScript("Controllers/Distributors/distributorController.js");
    addScript("Controllers/Managers/managerController.js");
    addScript("Controllers/WarrantyRecords/warrantyRecordController.js");
    addScript("Controllers/Products/productController.js");
    addScript("Controllers/CertificationProviders/certificationProviderController.js");
    addScript("Controllers/CertifiedProfessionals/certifiedProfessionalController.js");
    addScript("Controllers/Certifcations/certificationController.js");
    addScript("Controllers/Branches/branchesController.js");
    addScript("Controllers/User/userController.js");
    console.log("loading controllers done.");
    alert("Initialised");
}    

init();
