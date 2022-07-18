<div>
    <x-jet-button wire:click.prevent="download">
        Export Data
    </x-jet-button>

    @foreach($errors->all() as $error)
        {{  $error }} <br/>
    @endforeach

    <x-jet-dialog-modal wire:model="hasError">
        <x-slot name="title">
            Uh oh!
        </x-slot>

        <x-slot name="content">
            {!!  $message !!}

            <ul>
                @foreach ($errors->all() as $error)
                   <li>{{ $error }} </li>
                @endforeach
            </ul>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('hasError')">
                Okay!
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
