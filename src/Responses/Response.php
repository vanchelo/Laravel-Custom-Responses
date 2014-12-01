<?php namespace Vanchelo\CustomResponses\Responses;

use Request;
use View;
use Illuminate\Http\Response as BaseResponse;

class Response extends BaseResponse
{
    /**
     * Default reponse view template
     *
     * @var string
     */
    protected $view = 'responses.default';

    /**
     * Response status code
     *
     * @var
     */
    protected $defaultCode;

    /**
     * @param string $content
     * @param int    $status
     * @param array  $headers
     */
    public function __construct($content = '', $status = 200, $headers = [])
    {
        parent::__construct($content, $status, $headers);

        $this->prepareResponse();
    }

    /**
     * Prepare custom response
     */
    protected function prepareResponse()
    {
        $this->setStatusCode($this->defaultCode ?: $this->statusCode);

        $data = $this->prepareData();

        $this->afterPrepareData($data);

        $this->setContent(Request::wantsJson() || Request::ajax()
            ? $data
            : View::make($this->view, $data)
        );
    }

    /**
     * After prepare response data.
     * Create or Modify reponse data here
     *
     * @param array $data
     */
    protected function afterPrepareData(array & $data)
    {
        //
    }

    /**
     * Prepare response data
     *
     * @return array
     */
    protected function prepareData()
    {
        return [
            'error' => true,
            'status' => $this->statusText,
            'code' => $this->statusCode
        ];
    }
}
