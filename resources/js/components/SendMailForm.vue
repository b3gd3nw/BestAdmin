<template>
    <div class="card auto-card">
        <div class="card-header">
            <b-icon icon="envelope-open" size="is-small"></b-icon>
            <h1 class="subtitle">
                Send form on email
            </h1>
        </div>
        <div class="container">
            <form action="">
                <div class="form-header">
                    <b-icon icon="envelope-open-text" size="is-large"></b-icon>
                </div>
                <div class="form-body">
                   <div class="wrapper">
                        <div class="columns">
                            <div class="column is-flex is-align-items-center">
                                <b-field label="Email"
                                        type="is-danger"
                                        message="This email is invalid">
                                        <b-input type="email"
                                            maxlength="30">
                                        </b-input>
                                </b-field>
                            </div>
                        </div>
                   </div>
                </div>
                <div class="form-footer">
                    
                </div>
                
            </form>
        </div>
        <div class="card-footer">
            <b-button type="is-link">Send</b-button>
        </div>
    </div>
</template>
<script>
export default {
    
}
</script>