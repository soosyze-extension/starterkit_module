<?php

namespace SoosyzeExtension\Starterkit\Services;

class HookConfig implements \SoosyzeCore\Config\Services\ConfigInterface
{
    public function menu(&$menu)
    {
        $menu[ 'starterkit' ] = [
            'title_link' => 'Starterkit'
        ];
    }

    public function form(&$form, $data, $req)
    {
        return $form->group('start-fieldset', 'fieldset', function ($form) use ($data) {
            $form->legend('start-legend', t('Settings'))
                    ->group('start_check-group', 'div', function ($form) use ($data) {
                        $form->checkbox('start_check', [ 'checked' => $data[ 'start_check' ] ])
                        ->label('start_check-label', '<span class="ui"></span> ' . t('Start check'), [
                            'for' => 'start_check'
                        ]);
                    }, [ 'class' => 'form-group' ])
                    ->group('start_text-group', 'div', function ($form) use ($data) {
                        $form->label('start_text-label', t('Start text'))
                        ->text('start_text', [
                            'class'    => 'form-control',
                            'required' => 1,
                            'value'    => $data[ 'start_text' ]
                        ]);
                    }, [ 'class' => 'form-group' ]);
        })
                ->token('config_starterkit')
                ->submit('submit', t('Save'), [ 'class' => 'btn btn-success' ]);
    }

    public function validator(&$validator)
    {
        $validator->setRules([
            'start_check'       => '!required|bool',
            'start_text'        => 'required|string|max:255',
            'config_starterkit' => 'token'
        ]);
    }

    public function before(&$validator, &$data, $id)
    {
        $data = [
            'start_check' => $validator->getInput('start_check'),
            'start_text'  => $validator->getInput('start_text')
        ];
    }

    public function after(&$validator, $data, $id)
    {
    }

    public function files(&$inputsFile)
    {
    }
}
