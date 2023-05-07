const excelInput = document.getElementById("excelInput")
console.log(excelInput)
    
excelInput.addEventListener("change", async function(){
    const content = await readXlsxFile(excelInput.files[0])

    console.log(content)
})