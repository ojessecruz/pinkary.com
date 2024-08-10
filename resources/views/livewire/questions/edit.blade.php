<div class="border-l border-slate-900">
    <form wire:submit="update">
        <div class="mt-4 flex items-center justify-between">
            <div class="w-full">
                <div class="mb-1">
                    <label
                        for="{{ 'edit_update_'.$question->id }}"
                        class="sr-only"
                        >Answer</label
                    >

                    <textarea
                        id="{{ 'edit_update_'.$question->id }}"
                        wire:model="content"
                        x-autosize
                        class="h-24 w-full resize-none border-none border-transparent bg-transparent text-white focus:border-transparent focus:outline-0 focus:ring-0"
                        placeholder="Edit your update..."
                        maxlength="1000"
                        rows="3"
                    ></textarea>

                    <p class="text-right text-xs text-slate-400"><span x-text="$wire.content.length"></span> / 1000</p>

                    @error('content')
                        <x-input-error
                            :messages="$message"
                            class="mt-2"
                        />
                    @enderror
                </div>
                <div class="flex items-center justify-between gap-4">
                    <div class="items center ml-2 flex gap-4">
                        <x-primary-colorless-button
                            class="text-{{ $user->left_color }} border-{{ $user->left_color }}"
                            type="submit"
                        >
                            {{ __('Send') }}
                        </x-primary-colorless-button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
