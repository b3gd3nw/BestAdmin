    <div class="columns">
    <div class="column is-4">
        <div class="card has-background-primary hoverable">
            <div class="card-content">
                <p class="title" id="balance">
                    $ {{ $bank }}
                </p>
                <p class="subtitle">
                    Current balance
                </p>
            </div>
        </div>
    </div>
    <div class="column is-4">
        <div class="card has-background-link">
            <div class="card-content">
                <p class="title">
                    $10.0000
                </p>
                <p class="subtitle">
                    Monthly budget
                </p>
            </div>
        </div>
    </div>
    <div class="column is-4">
        <div class="card has-background-danger">
            <div class="card-content">
                <p class="title">
                    $ {{ $consumptions }}
                </p>
                <p class="subtitle">
                    Current expenses per month
                </p>
            </div>
        </div>
    </div>
</div>
