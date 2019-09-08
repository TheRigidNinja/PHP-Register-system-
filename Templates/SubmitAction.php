<input type="submit" class="btn btn-outline-primary form-control text-center">

<a class="btn btn-outline-primary form-control text-center" href="#" id="Redirect"><?php echo htmlspecialchars($btnType); ?></a>


<script>

    $("#Redirect").click(()=>{
        $.ajax({
            type: "POST",
            url: "index.php",
            success:(result)=>{
                alert(result)
            }
        })
    });
</script>