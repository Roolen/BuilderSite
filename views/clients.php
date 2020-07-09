<div id="app">
    <main class="main">
        <h1>Clients</h1>
        <button v-if="!isAdding"
                @click="isAdding=true"
                type="button"
                class="add-button mrg-top-20">+</button>

        <div v-if="isAdding" class="row add-row mrg-bottom-50">
            <input v-model="clientFields['first_name']" type="text" class="edit-field" placeholder="First Name">
            <input v-model="clientFields['middle_name']" type="text" class="edit-field" placeholder="Middle Name">
            <input v-model="clientFields['last_name']" type="text" class="edit-field" placeholder="Last Name">
            <input v-model="clientFields['address']" type="text" class="edit-field" placeholder="Address">
            <input v-model="clientFields['phone']" type="tel" class="edit-field" placeholder="Phone">
            <button @click="insertClient" class="insert-button">Add</button>
        </div>

        <div :style="messageColor" class="message"> {{ message }} </div>

        <div class="row client-row head-row">
            <div class="row-cell">ID</div>
            <div class="row-cell">First Name</div>
            <div class="row-cell">Middle Name</div>
            <div class="row-cell">Last Name</div>
            <div class="row-cell">Address</div>
            <div class="row-cell">Phone</div>
        </div>

        <?php foreach ($clients as $client) : ?>
            <div class="row client-row">
                <div class="row-cell"> <?= $client['id']          ?> </div>
                <div class="row-cell"> <?= $client['first_name']  ?> </div>
                <div class="row-cell"> <?= $client['middle_name'] ?> </div>
                <div class="row-cell"> <?= $client['last_name']   ?> </div>
                <div class="row-cell"> <?= $client['address']     ?> </div>
                <div class="row-cell"> <?= $client['phone']       ?> </div>
            </div>
        <?php endforeach ?>
    </main>
</div>
<script src=" <?= $content ?>/js/vue.min.js"></script>
<script src=" <?= $content ?>/js/app.js"></script>