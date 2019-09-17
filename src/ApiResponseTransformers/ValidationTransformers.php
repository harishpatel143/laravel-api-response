<?php


namespace HarishPatel\ApiResponse\ApiResponseTransformers;


class ValidationTransformers
{
    /**
     * response message
     *
     * @param array $errors
     * @return array
     */
    public function response($errors)
    {
        $transformed = [];
        foreach ($errors as $field => $message) {
            $transformed[] = [
                'field' => $field,
                'message' => (method_exists($this, 'message')) ? $this->container->call([
                    $this,
                    'message'
                ]) : $message[0]
            ];
        }

        return $transformed;
    }
}