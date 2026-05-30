<script>
(function() {
    const uid = @json(session('firebase_uid'));
    if (!uid) return;
    fetch(`https://pawfeeder-456a9-default-rtdb.asia-southeast1.firebasedatabase.app/users/${uid}/pet_name.json`)
        .then(r => r.json())
        .then(name => {
            if (name) document.querySelectorAll('.pet-name').forEach(el => el.textContent = name);
        });
})();
</script>