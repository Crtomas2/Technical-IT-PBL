<x-jet-dialog-modal wire:model="active">
    <x-slot name="title">
        Import Promodisers
    </x-slot>

    <x-slot name="content">
        <div>
            <form wire:submit.prevent="import" enctype="multipart/form-data">
                <div class="relative">
                    <div>
                        <div class="flex flex-col">
                            <div class="flex-1">
                                <label for="file" class="col-sm-2 col-form-label">
                                    Data File
                                </label><br>

                                <small id="fileHelpBlock" class="form-text text-muted">
                                    The file must be an excel file (XLSX) or a comma-delimited value file (CSV)
                                </small>
                            </div>
                            <div class="flex-1 mt-4">
                                <div class="relative flex items-center justify-between">
                                    <input type="file" class="block w-full text-sm text-gray-900 bg-gray-50 p-2 rounded-lg border border-gray-300 cursor-pointer focus:outline-none" wire:model="file" id="file" name="file" aria-describedBy="fileHelpBlock" required />
                                    <x-jet-button class="ml-2" wire:click="import()" wire:loading.attr="disabled">
                                        <span>Import</span>
                                    </x-jet-button>
                                </div>
                                <x-jet-input-error for="file" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="mt-4">
            <x-jet-input-error for="temp_data" class="mt-2" />
            <livewire:promodisers.import-table />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('active')" wire:loading.attr="disabled">
            Cancel
        </x-jet-secondary-button>

        <x-jet-button class="ml-2" wire:click="upload()" wire:loading.attr="disabled">
            <span>Upload</span>
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
